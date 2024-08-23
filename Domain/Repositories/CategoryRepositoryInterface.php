<?php

namespace Domain\Repositories;

use Domain\Entities\Category;

interface CategoryRepositoryInterface
{
    public function findById(int $id): ?Category;
    
    public function findAll(): array;
    
    public function save(Category $category): void;
    
    public function update(Category $category): void;
    
    public function delete(int $id): void;
}
