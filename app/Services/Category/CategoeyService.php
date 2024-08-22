<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Models\Product;
use App\Traits\CrudTrait;
use App\Traits\UplodeImagesTrait;
use Illuminate\Support\Facades\DB;


class CategoeyService
{
    use CrudTrait, UplodeImagesTrait;

    private $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $relatation = ['products'];
        return $this->getAllByRelation($relatation);
    }

    public function getOne($id)
    {
        return $this->show($id);
    }

    public function store($request)
    {
        if (isset($request->image)) {
            $this->uplodeImages($request, $this->model, 'image');
        }
        $data = $this->model->create($request->all());

        if ($request->hasFile('auther_image')) {
            foreach ($request->file('auther_image') as $image) {
                $data->addMedia($image)->toMediaCollection('auther_image');
            }
        }
        return $data;
    }

    public function update($request, $id)
    {
        $record = $this->model->find($id);
        $record->update($request->all());
        return $record;
    }

    public function destroy($id)
    {
        $record = $this->model->find($id);
        $record->delete();
        return $record;
    }
}
