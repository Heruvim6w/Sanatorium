<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use MoonShine\Models\MoonshineUser;

class AdminNotificationAboutRegisterUser
{
    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $admin = MoonshineUser::query()->where('name', 'Admin')->first();

        if (! $event->user->hasVerifiedEmail()) {
            $user = $event->user;
            Mail::send('emails.admin_inbox', ['user' => $user], function ($message) use ($admin) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
                $message->to($admin->email, $admin->name)->subject('Новый пользователь на сайте');
            });
        }
    }
}
