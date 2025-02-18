<?php
use Illuminate\Support\Facades\Mail;

Mail::raw('This is a test email.', function ($message) {
    $message->to('recipient@example.com') // Replace with a real recipient email
            ->subject('Test Email');
});
