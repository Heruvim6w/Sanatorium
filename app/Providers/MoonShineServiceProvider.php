<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\AdsResource;
use App\MoonShine\Resources\ArticleResource;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\DocumentResource;
use App\MoonShine\Resources\GardenersResource;
use App\MoonShine\Resources\MeetingResource;
use App\MoonShine\Resources\NewsResource;
use App\MoonShine\Resources\UserResource;
use MoonShine\Menu\MenuDivider;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [];
    }

    protected function pages(): array
    {
        return [];
    }

    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
               MenuItem::make(
                   static fn() => __('moonshine::ui.resource.admins_title'),
                   new MoonShineUserResource()
               ),
               MenuItem::make(
                   static fn() => __('moonshine::ui.resource.role_title'),
                   new MoonShineUserRoleResource()
               ),
            ]),

            MenuGroup::make('Статьи', [
                MenuItem::make('Все статьи', new ArticleResource())
                    ->icon('heroicons.outline.academic-cap'),

                MenuDivider::make(),

                MenuItem::make('Новости', new NewsResource())
                    ->icon('heroicons.outline.newspaper'),

                MenuItem::make('Объявления', new AdsResource())
                    ->icon('heroicons.outline.squares-2x2'),

                MenuItem::make('Общие собрания', new MeetingResource())
                    ->icon('heroicons.outline.chat-bubble-bottom-center-text'),

                MenuItem::make('Садоводам СНТ', new GardenersResource())
                    ->icon('heroicons.outline.user'),

                MenuDivider::make(),

                MenuItem::make('Категории', new CategoryResource())
                    ->icon('heroicons.outline.folder')
            ])->icon('heroicons.academic-cap'),

            MenuItem::make('Документы', new DocumentResource())
                ->icon('heroicons.outline.document-text'),

            MenuItem::make('Пользователи', new UserResource())
                ->icon('heroicons.outline.users'),
        ];
    }

    /**
     * @return array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
