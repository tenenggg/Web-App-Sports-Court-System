<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GoogleCalendarController extends Controller
{
    protected $client;

    public function __construct(Google_Client $client)
    {
        $this->client = $client;
    }

    public function addToCalendar(Booking $booking)
    {
        try {
            if (!session('google_token')) {
                $authUrl = $this->client->createAuthUrl();
                session(['booking_to_add' => $booking->id]);
                \Log::info('No token found, redirecting to auth URL', ['url' => $authUrl]);
                return redirect()->away($authUrl);
            }

            $this->client->setAccessToken(session('google_token'));
            \Log::info('Access token set', ['token' => session('google_token')]);

            if ($this->client->isAccessTokenExpired()) {
                \Log::info('Token is expired, attempting refresh');
                if ($this->client->getRefreshToken()) {
                    $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                    session(['google_token' => $this->client->getAccessToken()]);
                    \Log::info('Token refreshed successfully');
                } else {
                    \Log::error('No refresh token available');
                    return redirect()->route('user.bookinghistory.index')
                        ->with('error', 'Google Calendar authorization expired. Please try again.');
                }
            }

            $service = new Google_Service_Calendar($this->client);

            // Create Carbon instances and keep them in Malaysia timezone
            $startTime = Carbon::parse($booking->booking_date . ' ' . $booking->start_time, 'Asia/Kuala_Lumpur');
            $endTime = Carbon::parse($booking->booking_date . ' ' . $booking->end_time, 'Asia/Kuala_Lumpur');

            // Create event with Malaysia timezone
            $event = new Google_Service_Calendar_Event([
                'summary' => 'Court Booking: ' . $booking->venue->name,
                'location' => $booking->venue->name,
                'description' => "Booking ID: {$booking->id}\nVenue: {$booking->venue->name}\nTotal Price: RM" . number_format($booking->total_price, 2),
                'start' => [
                    'dateTime' => $startTime->toIso8601String(), // This will include the proper timezone offset
                    'timeZone' => 'Asia/Kuala_Lumpur',
                ],
                'end' => [
                    'dateTime' => $endTime->toIso8601String(), // This will include the proper timezone offset
                    'timeZone' => 'Asia/Kuala_Lumpur',
                ],
                'reminders' => [
                    'useDefault' => true,
                ],
            ]);

            \Log::info('Attempting to create calendar event', [
                'event' => [
                    'summary' => $event->getSummary(),
                    'start_time' => $startTime->format('Y-m-d H:i:s P'),
                    'end_time' => $endTime->format('Y-m-d H:i:s P'),
                    'timezone' => 'Asia/Kuala_Lumpur'
                ]
            ]);

            $calendarId = 'primary';
            $event = $service->events->insert($calendarId, $event);
            
            \Log::info('Event created successfully', ['event_id' => $event->getId()]);

            return redirect()->route('user.bookinghistory.index')
                ->with('success', 'Event added to your Google Calendar successfully!');

        } catch (\Exception $e) {
            \Log::error('Google Calendar Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('user.bookinghistory.index')
                ->with('error', 'Failed to add event to Google Calendar: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        \Log::info('Received callback from Google', [
            'code_exists' => $request->has('code'),
            'error' => $request->get('error'),
            'state' => $request->get('state')
        ]);
        
        if (!$request->has('code')) {
            \Log::error('No authorization code received');
            return redirect()->route('user.bookinghistory.index')
                ->with('error', 'Google Calendar authorization failed.');
        }

        try {
            $token = $this->client->fetchAccessTokenWithAuthCode($request->code);
            \Log::info('Token fetched', ['token_type' => $token['token_type'] ?? 'none']);
            
            $this->client->setAccessToken($token);
            session(['google_token' => $token]);

            if (session('booking_to_add')) {
                $booking = Booking::find(session('booking_to_add'));
                session()->forget('booking_to_add');
                
                if ($booking) {
                    \Log::info('Found booking to add', ['booking_id' => $booking->id]);
                    return $this->addToCalendar($booking);
                }
            }

            return redirect()->route('user.bookinghistory.index')
                ->with('success', 'Google Calendar connected successfully!');
            
        } catch (\Exception $e) {
            \Log::error('Google Calendar Callback Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('user.bookinghistory.index')
                ->with('error', 'Failed to connect to Google Calendar: ' . $e->getMessage());
        }
    }
} 