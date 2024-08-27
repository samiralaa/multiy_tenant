<?php

namespace App\Models\Marketing;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $connection = 'tenant';
    protected $table = 'marketing_project';
    protected $fillable = [
        'name',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
