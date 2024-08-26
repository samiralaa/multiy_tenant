<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Models\Product;
use App\Traits\CrudTrait;
use App\Models\Image;
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
       $category = $this->model->find($id);
       $images = $category->images;
       return response()->json($images);
    }

    public function store($request)
    {
        // Create the main record
        $record = $this->model->create($request->all());
    
        // Check if an image was uploaded
        if ($request->hasFile('image')) {

            // Store the image and get the path
            $imagePath = $request->file('image')->store('images');
    
            // Create a new Image instance and associate it with the record
            $image = new Image();
            $image->url = $imagePath;
            $image->imageable_id = $record->id;
            $image->imageable_type = get_class($record); // Set the related model's class name
   
            // Save the image to the database
            $image->save();
        }
    
        return $record;
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
