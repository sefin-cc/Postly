<?php

namespace App\Listeners;

use App\Events\UserSubscribed;
use Illuminate\Support\Facades\Mail;

class SendSubscriberEmail
{
    /**
     * Handle the event.
     */
    public function handle(UserSubscribed $event): void
    {
        Mail::send('emails.newsletter', ['user' => $event->user], function($message) use ($event) {
            $message->to($event->user->email);
            $message->subject('Thank you for Subscribing');
        });
    }
}
