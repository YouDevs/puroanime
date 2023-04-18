<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'anime_id',
        'title',
        'episode_number',
        'summary',
        'air_date',
        'type',
    ];

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
