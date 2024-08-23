<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CatrgoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }
}
