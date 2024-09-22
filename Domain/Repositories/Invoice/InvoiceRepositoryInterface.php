<?php

namespace Domain\Repositories\Invoice;
use App\Models\Invoice;

interface InvoiceRepositoryInterface
{
    public function all(): array;
    public function find(int $id): ?Invoice;
    public function create(array $data): Invoice;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}