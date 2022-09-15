<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'cover'
    ];

    // One (category) to many (posts) relationship
    public function category() {
        return $this->belongsTo('App\Category');
    }

    // Many (posts) to many (tags) relationship
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
