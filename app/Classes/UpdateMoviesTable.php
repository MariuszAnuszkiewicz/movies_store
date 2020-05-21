<?php

namespace App\Classes;

use App\Classes\Abstracts\HubRepositories;

class UpdateMoviesTable extends HubRepositories
{
    public function process($request, $id)
    {
        $this->movieRepository->update($request->all(), $id);
    }
}
