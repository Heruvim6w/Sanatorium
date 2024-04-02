<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

use MoonShine\Fields\Image;
use MoonShine\Fields\Select;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<Article>
 */
class ArticleResource extends ModelResource
{
    protected string $model = Article::class;

    protected string $title = 'Статьи';

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
                TinyMce::make('Текст', 'content')
                    ->hideOnIndex()
                    ->required(),
                Image::make('Изображение', 'image')
                    ->hideOnIndex(),
                Select::make('Категория', 'category_id')
                    ->options(
                        Category::all()
                            ->pluck('title', 'id')
                            ->toArray()
                    )
                    ->required(),
                Switcher::make('Опубликовано', 'is_published'),
                Slug::make('Ссылка', 'slug')
                    ->unique()
                    ->from('title')
                    ->hint('Заполнится автоматически, если оставить пустым')
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function filters(): array
    {
        return [
            Select::make('Категория', 'category_id')
                ->options(
                    Category::all()
                        ->pluck('title', 'id')
                        ->toArray()
                ),
        ];
    }
}
