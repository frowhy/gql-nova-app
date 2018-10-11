<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Tags\HasTags;

class Post extends Model implements HasMedia
{
    use HasTags, HasMediaTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
