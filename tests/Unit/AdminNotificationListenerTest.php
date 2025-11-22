<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Bus;
use Illuminate\Auth\Events\Registered;
use Illuminate\Notifications\SendQueuedNotifications;
use App\Services\AdminResolver;
use App\Listeners\AdminNotificationAboutRegisterUser;
use App\Notifications\AdminNewUserNotification;
use App\Models\User;

class AdminNotificationListenerTest extends TestCase
{
    use RefreshDatabase;

    public function test_listener_sends_notification_to_admin_for_unverified_user(): void
    {
        Notification::fake();

        $user = User::factory()->create(['email' => 'user@example.test', 'email_verified_at' => null]);
        $admin = User::factory()->create(['email' => 'admin@example.test']);

        // мок AdminResolver, чтобы вернуть администратора
        $mock = $this->createMock(AdminResolver::class);
        $mock->method('getAdmin')->willReturn($admin);
        $this->app->instance(AdminResolver::class, $mock);

        // получить листнер из контейнера (чтобы DI сработал)
        $listener = $this->app->make(AdminNotificationAboutRegisterUser::class);

        $event = new Registered($user);

        $listener->handle($event);

        // т.к. используем AnonymousNotifiable (Notification::route), проверяем on-demand отправку
        Notification::assertSentOnDemand(AdminNewUserNotification::class, function ($notification, $channels, $notifiable) use ($user, $admin) {
            $okUser = isset($notification->user) && ($notification->user->email ?? null) === $user->email;
            $okChannel = is_array($channels) ? in_array('mail', $channels, true) : ($channels === 'mail');
            $okNotifiable = isset($notifiable->routes) && (($notifiable->routes['mail'] ?? null) === $admin->email);

            return $okUser && $okChannel && $okNotifiable;
        });
    }

    public function test_listener_does_not_send_for_verified_user(): void
    {
        Notification::fake();

        $user = User::factory()->create(['email' => 'user2@example.test', 'email_verified_at' => now()]);
        $admin = User::factory()->create(['email' => 'admin2@example.test']);

        $mock = $this->createMock(AdminResolver::class);
        $mock->method('getAdmin')->willReturn($admin);
        $this->app->instance(AdminResolver::class, $mock);

        $listener = $this->app->make(AdminNotificationAboutRegisterUser::class);
        $event = new Registered($user);

        $listener->handle($event);

        Notification::assertNothingSent();
    }

    public function test_listener_queues_notification(): void
    {
        // проверяем, что уведомление ставится в очередь (диспатчится SendQueuedNotifications)
        Bus::fake();

        $user = User::factory()->create(['email' => 'user3@example.test', 'email_verified_at' => null]);
        $admin = User::factory()->create(['email' => 'admin3@example.test']);

        $mock = $this->createMock(AdminResolver::class);
        $mock->method('getAdmin')->willReturn($admin);
        $this->app->instance(AdminResolver::class, $mock);

        $listener = $this->app->make(AdminNotificationAboutRegisterUser::class);
        $event = new Registered($user);

        $listener->handle($event);

        Bus::assertDispatched(SendQueuedNotifications::class);
    }
}
