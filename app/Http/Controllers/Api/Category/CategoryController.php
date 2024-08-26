<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Services\Category\CategoeyService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;
    public function __construct(CategoeyService $categoryService)
    {
        $this->categoryService = $categoryService;
        
    }
    public function index()
    {
        return $this->categoryService->getAll();
    }

    public function store(Request $request)
    {
        return $this->categoryService->store($request);
    }

    public function show($id)
    {
        return $this->categoryService->getOne($id);
    }
    public function update(Request $request, $id)
    {
        return $this->categoryService->update($request, $id);
    }
    
}
