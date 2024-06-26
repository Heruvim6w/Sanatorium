<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

use MoonShine\Fields\Select;
use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<Article>
 */
class ArticleResource extends AbstractArticleResource
{
    protected string $title = 'Все статьи';

    public function fields(): array
    {
        $parentFields = parent::fields();

        return array_merge($parentFields, [
            Select::make('Категория', 'category_id')
                ->options(
                    Category::all()
                        ->pluck('title', 'id')
                        ->toArray()
                )
                ->required(),
        ]);
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
