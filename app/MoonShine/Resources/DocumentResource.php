<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

use MoonShine\Fields\File;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

/**
 * @extends ModelResource<Document>
 */
class DocumentResource extends ModelResource
{
    protected string $model = Document::class;

    protected string $title = 'Documents';

    public function search(): array
    {
        return ['id', 'title', 'slug'];
    }

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Название', 'title')
                    ->required()
                    ->sortable(),
                Slug::make('Ссылка', 'slug')
                    ->unique()
                    ->from('title')
                    ->hint('Заполнится автоматически, если оставить пустым'),
                File::make('Файл', 'file')
                    ->allowedExtensions(['pdf', 'doc', 'docx'])
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
