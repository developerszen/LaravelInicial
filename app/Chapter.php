<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    function book() {
        return $this->belongsTo(Book::class);
    }
}
