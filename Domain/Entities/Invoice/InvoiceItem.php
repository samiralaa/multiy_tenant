<?php
namespace Domain\Entities\Invoice;

class InvoiceItem
{
    private int $id;
    private string $description;
    private int $quantity;
    private float $price;
    private float $total;

    public function __construct(
        int $id,
        string $description,
        int $quantity,
        float $price,
        float $total
    ) {
        $this->id = $id;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->total = $total;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTotal(): float
    {
        return $this->total;
    }
}