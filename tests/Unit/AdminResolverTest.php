<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use App\Services\AdminResolver;
use App\Models\User;

class AdminResolverTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_admin_by_email_from_config(): void
    {
        Cache::forget('app_admin_user');

        $email = 'admin@example.test';
        config(['moonshine.admin_email' => $email]);

        $user = User::factory()->create(['email' => $email]);

        $resolver = new AdminResolver();
        $admin = $resolver->getAdmin();

        $this->assertNotNull($admin);
        $this->assertEquals($email, $admin->email);
        $this->assertEquals($user->id, $admin->id);
    }
}

