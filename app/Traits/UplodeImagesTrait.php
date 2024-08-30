<?php

namespace App\Traits;

trait UplodeImagesTrait
{
    public function uplodeImages($request, $model, $column)
    {
        if ($request->hasFile($column)) {
         
            $file = $request->file($column);
            $name = time() . '_' . $file->getClientOriginalName(); // Unique name
            $file->move(public_path('uploads'), $name);
            $model->$column = $name; // Save the file name to the model
        }
    }

    public function deleteImages($model, $column)
    {
        // Check if the image exists before deleting
        if (isset($model->$column) && file_exists(public_path('uploads/' . $model->$column))) {
            unlink(public_path('uploads/' . $model->$column));
            $model->$column = null; // Clear the image path from the model
        }
    }
}
