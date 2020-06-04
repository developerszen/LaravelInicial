<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['user_id', 'category_id', 'title', 'synopsis', 'image'];

    function authors() {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }
}