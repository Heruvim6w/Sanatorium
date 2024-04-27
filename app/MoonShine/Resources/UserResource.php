<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use MoonShine\Fields\Email;
use MoonShine\Fields\Password;
use MoonShine\Fields\PasswordRepeat;
use MoonShine\Fields\Phone;
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

    public function search(): array
    {
        return ['last_name', 'phone', 'email'];
    }

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Имя', 'first_name')
                    ->required()
                    ->sortable(),
                Text::make('Отчество', 'second_name')
                    ->required()
                    ->sortable(),
                Text::make('Фамилия', 'last_name')
                    ->required()
                    ->sortable(),
                Phone::make('Телефон', 'phone')
                    ->required()
                    ->mask('+79999999999')
                    ->sortable(),
                Email::make('Email', 'email')
                    ->required()
                    ->sortable(),
                Switcher::make('Заблокирован', 'is_blocked')
                    ->sortable(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
