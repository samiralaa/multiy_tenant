<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'domain', 'database_config'];

   
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
