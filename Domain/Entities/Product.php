<?php
// domain/Entities/Product.php
namespace Domain\Entities;

class Product
{
    private int $id;
    private string $name;
    private float $price;
    private ?\DateTime $manufactureDate;

    public function __construct(int $id, string $name, float $price, ?\DateTime $manufactureDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->manufactureDate = $manufactureDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getManufactureDate(): ?\DateTime
    {
        return $this->manufactureDate;
    }
    
    // Business logic to calculate discount based on manufacture date
    public function getDiscountedPrice(float $discountPercentage): float
    {
        return $this->price * (1 - $discountPercentage / 100);
    }
}

// 