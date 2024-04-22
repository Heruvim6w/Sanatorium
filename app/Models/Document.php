<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property string $file
 * @property string $slug
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Document extends Model
{
    use HasFactory;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
