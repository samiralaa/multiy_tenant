// domain/Repositories/ProductRepositoryInterface.php
<?php
namespace Domain\Repositories;

use Domain\Entities\Product;

interface ProductRepositoryInterface
{
    public function find(int $id): ?Product;
    public function save(Product $product): void;
    public function delete(int $id): void;
}
