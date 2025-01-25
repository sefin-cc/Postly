<?php

namespace App\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetSuccessEmail
{

    public function handle(PasswordReset $event): void
    {
        Mail::send('emails.password_reset', ['user' => $event->user], function($message) use ($event) {
            $message->to($event->user->email);
            $message->subject('Password Reset Confirmation');
        });
    }
}
