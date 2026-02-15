<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNewUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $user = $this->user;

        return (new MailMessage)
            ->subject('Новый пользователь на сайте')
            ->line('Зарегистрирован новый пользователь: ' . ($user->email ?? '---'))
            ->action('Открыть профиль', url(config('app.url') . '/admin/users/' . ($user->id ?? '')))
            ->line('');
    }
}

