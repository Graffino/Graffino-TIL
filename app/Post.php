<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
      'title', 'body', 'slug', 'likes', 'max_likes'. 'tweeted_at',
    ];
}
