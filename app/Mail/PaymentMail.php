<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $data['google_calendar_link'] = $this->generateGoogleCalendarLink($data);
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Court Booking Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.payment_mail',
            with: ['order' => $this->data] // Ensure data is passed with the correct key
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }

    private function generateGoogleCalendarLink($data)
    {
        // Specify the timezone of your application or database
        $timezone = 'Asia/Kuala_Lumpur'; // Replace with your desired timezone

        // Parse the booking date and times in the specified timezone
        $startDateTime = \Carbon\Carbon::parse("{$data['booking_date']} {$data['start_time']}", $timezone)
                                       ->setTimezone('UTC') // Convert to UTC for Google Calendar
                                       ->format('Ymd\THis\Z');
        $endDateTime = \Carbon\Carbon::parse("{$data['booking_date']} {$data['end_time']}", $timezone)
                                     ->setTimezone('UTC') // Convert to UTC for Google Calendar
                                     ->format('Ymd\THis\Z');

        // Event title, details, and location
        $title = urlencode('Court Booking');
        $details = urlencode('Your court booking details.');
        $location = urlencode('Court Hub Location'); // Replace with the actual location if necessary

        // Build the Google Calendar event link
        return "https://calendar.google.com/calendar/render?action=TEMPLATE&text={$title}&dates={$startDateTime}/{$endDateTime}&details={$details}&location={$location}";
    }

    public function build()
    {
        return $this->from('admin@courthub.com') // Ensure this is a valid and authorized email
                    ->view('mail.payment_mail')
                    ->with('data', $this->data);
    }
}
