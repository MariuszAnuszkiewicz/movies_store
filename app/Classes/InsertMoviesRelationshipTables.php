<?php

namespace App\Classes;

use App\Classes\Abstracts\HubRepositories;

class InsertMoviesRelationshipTables extends HubRepositories
{
    public function process($request)
    {
        $this->movieRepository->create($request->all());
        $lastInsert = [];
        foreach ($this->movieRepository->getAll() as $movie) {
            $lastInsert[] = $movie;
        }
        $explodeTypes = explode(",", $request->{'type'});
        for ($i = 0; $i < count($explodeTypes); $i++) {
            $types = $this->genreRepository->columnWhereIn('type', [$explodeTypes[$i]])->get();
            foreach ($types as $type) {
                $this->movieRepository->find($lastInsert[count($lastInsert) - 1]->id)->genres()->attach($type->id);
            }
        }
    }
}
