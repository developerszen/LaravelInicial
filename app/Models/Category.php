<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    protected $hidden = ['deleted_at'];

    function book() {
        return $this->hasOne(Book::class);
    }

    function scopeWithFields($query) {
        if (true) {
            return $query->select('id', 'name', 'created_at');
        }

        return $query->select('id', 'name');
    }
}
