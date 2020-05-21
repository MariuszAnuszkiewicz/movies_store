<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function getAll($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', '=', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function columnWhere($columns = ['*'], $value)
    {
        return $this->model->where($columns, '=', $value);
    }

    public function columnWhereIn($columns = ['*'], array $name)
    {
        return $this->model->whereIn($columns, $name);
    }

    public function search($name)
    {
        return $this->model->where('title', 'LIKE', '%'. $name .'%');
    }
}
