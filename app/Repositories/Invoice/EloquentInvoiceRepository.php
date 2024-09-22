<?php
namespace App\Repositories\Invoice;

use App\Models\Invoice;
use Domain\Repositories\Invoice\InvoiceRepositoryInterface;


class EloquentInvoiceRepository implements InvoiceRepositoryInterface
{
    public function all(): array
    {
        return Invoice::with('items')->get()->toArray();
    }

    public function find(int $id): ?Invoice
    {
        return Invoice::with('items')->find($id);
    }

    public function create(array $data): Invoice
    {
        $invoice = Invoice::create($data);

        // Handle invoice items if provided
        if (isset($data['items'])) {
            foreach ($data['items'] as $item) {
                $invoice->items()->create($item);
            }
        }

        return $invoice;
    }

    public function update(int $id, array $data): bool
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return false;
        }

        $invoice->update($data);

        // Update or create invoice items if provided
        if (isset($data['items'])) {
            $invoice->items()->delete();  // Delete old items
            foreach ($data['items'] as $item) {
                $invoice->items()->create($item);  // Add new items
            }
        }

        return true;
    }

    public function delete(int $id): bool
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return false;
        }

        return $invoice->delete();
    }
}