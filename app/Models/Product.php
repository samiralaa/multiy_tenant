<?php

namespace App\Models;

use App\Traits\BelongsToStore; // Import the trait
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory ,BelongsToStore;

    protected $connection = 'tenant';
    protected $fillable = ['name', 'price', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

  
}
