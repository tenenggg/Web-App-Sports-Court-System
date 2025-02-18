<?php

namespace App\Providers;

use Google_Client;
use Google_Service_Calendar;
use Illuminate\Support\ServiceProvider;

class GoogleCalendarServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Google_Client::class, function ($app) {
            $client = new Google_Client();
            $client->setAuthConfig(storage_path('app/google-calendar/credentials.json'));
            $client->addScope(Google_Service_Calendar::CALENDAR);
            $client->setAccessType('offline');
            $client->setPrompt('consent');
            
            // Add these lines to fix SSL issue in local development
            if (config('app.env') === 'local') {
                $client->setHttpClient(new \GuzzleHttp\Client([
                    'verify' => false // Disable SSL verification in local
                ]));
            }
            
            return $client;
        });
    }
} 