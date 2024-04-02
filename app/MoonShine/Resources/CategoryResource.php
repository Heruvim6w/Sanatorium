<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

use MoonShine\Fields\Image;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<Category>
 */
class CategoryResource extends ModelResource
{
    protected string $model = Category::class;

    protected string $title = 'Категории';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Название', 'title')
                    ->required()
                    ->sortable(),
                TinyMce::make('Описание', 'description')
                    ->hideOnIndex(),
                Image::make('Изображение', 'image')
                    ->hideOnIndex(),
                Slug::make('Ссылка', 'slug')
                    ->required()
                    ->unique()
                    ->from('title')
                    ->hint('Ссылка должна быть уникальной')
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
