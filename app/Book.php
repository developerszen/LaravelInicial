<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    function authors() {
        return $this->belongsToMany(Author::class);
    }

    function category() {
        return $this->belongsTo(Category::class);
    }

    function user() {
        return $this->belongsTo(User::class);
    }
}
