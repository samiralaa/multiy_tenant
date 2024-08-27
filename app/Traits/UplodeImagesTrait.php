<?php

namespace App\Traits;

trait UplodeImagesTrait
{
    public function uplodeImages($request, $model, $column)
    {
        if ($request->hasFile($column)) {
            $file = $request->file($column);
            $name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $name);
            $model->$column = $name;
        }
    }

    public function deleteImages($model, $column)
    {
        // التأكد من أن الصورة القديمة موجودة وحذفها
        if (isset($model->$column) && file_exists(public_path('uploads/' . $model->$column))) {
            unlink(public_path('uploads/' . $model->$column));
            $model->$column = null;
        }
    }
}
