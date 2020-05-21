<?php

namespace App\Classes;

use App\Classes\Abstracts\HubRepositories;

class DeleteMoviesTable extends HubRepositories
{
    public function process($id)
    {
        $this->movieRepository->delete($id);
    }
}
