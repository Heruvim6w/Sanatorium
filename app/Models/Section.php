<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'section'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
