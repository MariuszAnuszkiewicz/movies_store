<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'cover', 'description', 'country_of_production'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class)->withTimestamps();
    }
}
