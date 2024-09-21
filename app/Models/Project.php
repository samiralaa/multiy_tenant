<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasFactory, HasTranslations;
    protected $connection = 'tenant';
    protected $fillable = [ 'category_id', 'name', 'description'];
    public $translatable = ['name', 'description'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
