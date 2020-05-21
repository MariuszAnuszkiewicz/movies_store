<?php

namespace App\Classes;

use App\Models\Movie;

class SelectMoviesRelationshipTables
{
    const GENRES_TABLE = 'genres';
    public function process()
    {
        return $moviesWithGenres = Movie::with(self::GENRES_TABLE)->get();
    }
}
