<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $connection = 'tenant';
    protected $table = 'marketing_categories';
    protected $fillable = [
        'name',
        'description',
    ];

}
