<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
        'title',
        'author',
        'synopsis',
        'category',
        'story_cover',
        'tags',
        'status',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
