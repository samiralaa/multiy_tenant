<?php

namespace Domain\Repositories;

use Domain\Entities\RequestPrice;

interface RequestPriceRepositoryInterface
{
    public function save(RequestPrice $requestPrice): RequestPrice;
    public function findById(int $id): ?RequestPrice;
    public function update(RequestPrice $requestPrice): bool;
    public function delete(int $id): bool;
    public function all(): array;
}
