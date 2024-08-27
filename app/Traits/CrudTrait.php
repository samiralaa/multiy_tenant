<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait CrudTrait
{
  private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }
    public function index()
    {
        return $this->model->all();    
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function update(array $data, $id)
    {
        $record = $this->model->find($id); 
        $record->update($data);
        return $record;
    }   

    public function destroy($id)
    {
        $record = $this->model->find($id);
        $record->delete();
        return $record;
    }

    public function restore($id)
    {
        $record = $this->model->withTrashed()->find($id);
        $record->restore();
        return $record;
    }

    public function forceDelete($id)
    {
        $record = $this->model->withTrashed()->find($id);
        $record->forceDelete();
        return $record;
    }

    public function restoreAll()
    {
        $this->model->withTrashed()->restore();
    }

    public function forceDeleteAll()
    {
        $this->model->withTrashed()->forceDelete();
    }

   public function getAllByRelation($relation)
    {
        return $this->model->with($relation)->get();
    }

    public function getOneByRelation($relation, $id)
    {
        return $this->model->with($relation)->find($id);
    }

   public function getOneByRelationWithTrashed($relation, $id)
    {
        return $this->model->withTrashed()->with($relation)->find($id);
    }

    
    
}