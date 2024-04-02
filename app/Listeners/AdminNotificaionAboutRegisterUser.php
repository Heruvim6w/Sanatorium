<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class AdminNotificaionAboutRegisterUser
{
    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        Mail::send('emails.admin_inbox', ['user' => $event->user], function($message) {
            $message->from(env('ADMIN_EMAIL'), env('APP_NAME'));
            $message->to(env('ADMIN_EMAIL'), env('APP_NAME'))->subject('Новый пользователь на сайте');
        });
    }
}
