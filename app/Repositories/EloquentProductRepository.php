// app/Repositories/EloquentProductRepository.php
<?php
namespace App\Repositories;

use Domain\Entities\Product as DomainProduct;
use Domain\Repositories\ProductRepositoryInterface;
use App\Models\Product as EloquentProduct;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function find(int $id): ?DomainProduct
    {
        $eloquentProduct = EloquentProduct::find($id);
        return $eloquentProduct ? $this->toDomain($eloquentProduct) : null;
    }

    public function save(DomainProduct $product): void
    {
        $eloquentProduct = EloquentProduct::find($product->getId());
        if ($eloquentProduct) {
            $eloquentProduct->update([
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'manufacture_date' => $product->getManufactureDate(),
            ]);
        } else {
            EloquentProduct::create([
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'manufacture_date' => $product->getManufactureDate(),
            ]);
        }
    }

    public function delete(int $id): void
    {
        $eloquentProduct = EloquentProduct::find($id);
        if ($eloquentProduct) {
            $eloquentProduct->delete();
        }
    }

    private function toDomain(EloquentProduct $eloquentProduct): DomainProduct
    {
        return new DomainProduct(
            $eloquentProduct->id,
            $eloquentProduct->name,
            $eloquentProduct->price,
            $eloquentProduct->manufacture_date ? new \DateTime($eloquentProduct->manufacture_date) : null
        );
    }
}
