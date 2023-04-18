<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'thumbnail_image',
        'streaming_platforms',
    ];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
