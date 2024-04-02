<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use MoonShine\Fields\Email;
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<User>
 */
class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Users';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Имя', 'name')
                    ->required()
                    ->sortable(),
                Email::make('Email', 'email')
                    ->required()
                    ->sortable(),
                Password::make('Пароль', 'password')
                    ->required()
                    ->hideOnIndex(),
                PasswordRepeat::make('Подтверждение пароля', 'password_repeat')
                    ->required()
                    ->hideOnIndex(),
                Switcher::make('Активирован', 'is_active')
                    ->sortable(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
