<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\AdminResolver;
use App\Notifications\AdminNewUserNotification;

class AdminNotificationAboutRegisterUser implements ShouldQueue
{
    use InteractsWithQueue;

    private AdminResolver $adminResolver;

    public function __construct(AdminResolver $adminResolver)
    {
        $this->adminResolver = $adminResolver;
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $admin = $this->adminResolver->getAdmin();

        if (! $admin || empty($admin->email)) {
            Log::warning('AdminNotificationAboutRegisterUser: admin not found or has no email.');
            return;
        }

        $user = $event->user;

        // если пользователь подтвердил почту — ничего не делаем
        if (
            (!empty($user->email_verified_at))
            || (is_object($user) && method_exists($user, 'hasVerifiedEmail') && $user->hasVerifiedEmail())
        ) {
            return;
        }

        try {
            // используем AnonymousNotifiable через route, чтобы не требовать Notifiable на модели
            Notification::route('mail', $admin->email)
                ->notify(new AdminNewUserNotification($user));
        } catch (\Throwable $e) {
            // логируем ошибку, но не ломаем обработку очереди
            Log::error('Failed to notify admin about new user: ' . $e->getMessage(), [
                'admin_id' => $admin->id ?? null,
                'user_id' => $user->id ?? null,
            ]);
        }
    }
}
