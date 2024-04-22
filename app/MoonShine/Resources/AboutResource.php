<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\About;

use MoonShine\Fields\TinyMce;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<About>
 */
class AboutResource extends ModelResource
{
    protected string $model = About::class;

    protected string $title = 'Abouts';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Tinymce::make('О нас', 'content')->required(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function getActiveActions(): array
    {
        return ['view', 'update'];
    }
}
