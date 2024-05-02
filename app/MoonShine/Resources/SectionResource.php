<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;

use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Select;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<Section>
 */
class SectionResource extends ModelResource
{
    protected string $model = Section::class;

    protected string $title = 'Sections';

    public function search(): array
    {
        return ['section', 'fio'];
    }

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Number::make('section')
                    ->sortable()
                    ->required(),
                BelongsToMany::make('Участник', 'users', 'name', resource: new UserResource())
                    ->selectMode()
                    ->placeholder('Кликните и начните ввод для поиска')
                    ->inLine(badge: true),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
