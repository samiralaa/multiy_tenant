<?php

namespace App\Repositories;

use Domain\Repositories\CategoryRepositoryInterface;
use Domain\Entities\Category;
use App\Models\Category as EloquentCategory;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function findById(int $id): ?Category
    {
        $eloquentCategory = EloquentCategory::find($id);
        return $eloquentCategory ? $this->toDomain($eloquentCategory) : null;
    }

    public function findAll(): array
    {
        return EloquentCategory::all()->map(fn($category) => $this->toDomain($category))->toArray();
    }

    public function save(Category $category): void
    {
        $eloquentCategory = EloquentCategory::find($category->getId());
        if (!$eloquentCategory) {
            $eloquentCategory = new EloquentCategory();
        }
        $eloquentCategory->name = $category->getName();
        $eloquentCategory->description = $category->getDescription();
        $eloquentCategory->created_at = $category->getCreatedAt();
        $eloquentCategory->updated_at = $category->getUpdatedAt();
        $eloquentCategory->save();
    }

    public function update(Category $category): void
    {
        $this->save($category);
    }

    public function delete(int $id): void
    {
        EloquentCategory::destroy($id);
    }

    private function toDomain(EloquentCategory $eloquentCategory): Category
    {
        return new Category(
            $eloquentCategory->id,
            $eloquentCategory->name,
            $eloquentCategory->description,
            $eloquentCategory->created_at,
            $eloquentCategory->updated_at,
            [] // Assuming the projects are handled separately
        );
    }
}
