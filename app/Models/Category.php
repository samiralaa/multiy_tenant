<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $connection = 'tenant';
    protected $fillable = ['name','description'];

    
    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }


}
