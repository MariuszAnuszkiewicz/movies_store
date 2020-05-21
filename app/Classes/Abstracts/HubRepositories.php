<?php

namespace App\Classes\Abstracts;

use App\Repositories\GenreRepository;
use App\Repositories\MovieRepository;

abstract class HubRepositories
{
    protected $genreRepository, $movieRepository;

    public function __construct(GenreRepository $genreRepository, MovieRepository $movieRepository)
    {
        $this->genreRepository = $genreRepository;
        $this->movieRepository = $movieRepository;
    }
}
