<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = [
        'chapter_title',
        'story_chapter',
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}
