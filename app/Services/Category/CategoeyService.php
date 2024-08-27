<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Models\Product;
use App\Traits\CrudTrait;
use App\Models\Image;
use App\Traits\UplodeImagesTrait;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

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
        $relatation = ['projects', 'images'];
        return $this->getAllByRelation($relatation);
    }

    public function getOne($id)
    {
        $category = $this->model->with('images')->find($id);
        return response()->json($category);
    }

    public function store($request)
    {
        // Create the main record
        $record = $this->model->create($request->all());

        // Check if an image was uploaded
        if ($request->hasFile('image')) {

            // Store the image and get the path
            $imagePath = $request->file('image')->store('categories');

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
        
        // حذف الصورة القديمة إذا كانت موجودة
        if ($request->hasFile('image') && $record->image) {
            $this->deleteImages($record->image, 'url');  // حذف الصورة القديمة من التخزين
            $record->image->delete(); // حذف سجل الصورة من قاعدة البيانات
        }
    
        // تحديث السجل بالكود الجديد
        $record->update($request->all());
    
        // إضافة الصورة الجديدة إذا كانت موجودة في الطلب
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories');
            $image = new Image();
            $image->url = $imagePath;
            $image->imageable_id = $record->id;
            $image->imageable_type = get_class($record); // تحديد اسم صنف النموذج المرتبط
            $image->save();
        }
    
        return $record;
    }

    public function destroy($id)
    {
        $record = $this->model->find($id);

        if ($record) {
            $record->delete();
        } else {
            return response()->json(['message' => 'Record not found'], 404);
        }
    }
}
