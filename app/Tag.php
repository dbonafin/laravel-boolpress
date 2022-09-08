<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Many (posts) to many (tags) relationship
    public function posts() {
        return $this->belongsToMany('App\Post');
    }
}
