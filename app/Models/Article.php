<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $image
 * @property bool $is_published
 * @property Carbon $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $slug
 * @property-read Category $category
 */
class Article extends Model
{
    use HasFactory;

    public const PUBLISHED = 1;

    public const NEWS = 1;

    public const ADS = 2;

    public const MEETING = 3;

    public const FOR_GARDENERS = 4;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::addGlobalScope('published', static function (Builder $builder) {
            $builder->where('is_published', self::PUBLISHED);
        });
    }

    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'is_published',
        'published_at',
        'slug',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
