<?php

namespace App\Classes;

use App\Classes\Abstracts\HubRepositories;

class SearchMoviesTable extends HubRepositories
{
    public function process($request)
    {
        $title = $request->{'title'};
        return $this->movieRepository->search($title)->get();
    }
}
