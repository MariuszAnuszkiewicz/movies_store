<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function getAll();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function columnWhere($column, $id);

    public function columnWhereIn($column, array $name);
}
