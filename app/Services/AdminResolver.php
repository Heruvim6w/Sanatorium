<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use MoonShine\Models\MoonshineUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AdminResolver
{
    /**
     * Получить администратора. Результат кешируется.
     *
     * @return Model|null
     */
    public function getAdmin(): ?Model
    {
        return Cache::remember('app_admin_user', 60 * 60, function () {
            $adminEmail = config('moonshine.admin_email') ?? config('app.admin_email');
            $adminId = config('moonshine.admin_id');

            try {
                if ($adminId) {
                    // безопасно проверяем наличие таблицы moonshine_users
                    if (Schema::hasTable((new MoonshineUser())->getTable())) {
                        $moonAdminById = MoonshineUser::query()->where('id', $adminId)->first();
                        if ($moonAdminById) {
                            return $moonAdminById;
                        }
                    }

                    if (Schema::hasTable((new User())->getTable())) {
                        $userAdminById = User::query()->where('id', $adminId)->first();
                        if ($userAdminById) {
                            return $userAdminById;
                        }
                    }
                }

                if ($adminEmail) {
                    if (Schema::hasTable((new MoonshineUser())->getTable())) {
                        $moonAdminByEmail = MoonshineUser::query()->where('email', $adminEmail)->first();
                        if ($moonAdminByEmail) {
                            return $moonAdminByEmail;
                        }
                    }

                    if (Schema::hasTable((new User())->getTable())) {
                        $userAdminByEmail = User::query()->where('email', $adminEmail)->first();
                        if ($userAdminByEmail) {
                            return $userAdminByEmail;
                        }
                    }
                }

                // fallback по имени для MoonshineUser
                if (Schema::hasTable((new MoonshineUser())->getTable())) {
                    $moonAdminByName = MoonshineUser::query()->where('name', 'Admin')->first();
                    if ($moonAdminByName) {
                        return $moonAdminByName;
                    }
                }

                // и как последний шаг — по имени в основной таблице users
                if (Schema::hasTable((new User())->getTable())) {
                    $userAdminByName = User::query()->where('name', 'Admin')->first();
                    if ($userAdminByName) {
                        return $userAdminByName;
                    }
                }
            } catch (\Throwable $e) {
                Log::warning('AdminResolver error: ' . $e->getMessage());
            }

            return null;
        });
    }
}
