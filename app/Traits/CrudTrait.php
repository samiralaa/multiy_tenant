<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait CrudTrait
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function index($model, $select)
    {
        return $model->select($select)->get();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function show($model, $id, $select)
    {
        return $model->select($select)->find($id);
    }

    public function update($id, array $data)
    {
        $model = $this->model->find($id);

        if (!$model) {
            return false; // or throw an exception, or handle it however you'd like
        }

        $model->update($data);

        return $model;
    }


    public function delete($id)
    {
        $record = $this->model->find($id);
        $record->delete();
        return $record;
    }




    public function getAllByRelation($relation)
    {
        return $this->model->with($relation)->get();
    }

    public function getOneByRelation($relation, $id)
    {
        return $this->model->with($relation)->find($id);
    }

    public function getBySelect($select, $model)
    {
        return $model->select($select)->get();
    }

    public function getOneBySelect($select, $id)
    {
        return $this->model->select($select)->find($id);
    }
}
