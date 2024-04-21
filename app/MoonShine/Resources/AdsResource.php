<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

use MoonShine\Fields\Select;
use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<Article>
 */
class AdsResource extends AbstractArticleResource
{
    protected string $title = 'Объявления';

    public function query(): Builder
    {
        return parent::query()
            ->where('category_id', Article::ADS);
    }

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
                ->required()
                ->default(Article::ADS)
                ->disabled(),
        ]);
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function filters(): array
    {
        return [];
    }
}
