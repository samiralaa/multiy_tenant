<?php
namespace Domain\Entities\Invoice;


use DateTime;

class Invoice
{
    private int $id;
    private string $clientName;
    private string $clientLocation;
    private string $clientAddress;
    private float $total;
    private DateTime $dueDate;

    /**
     * @var InvoiceItem[]
     */
    private array $items = [];

    public function __construct(
        int $id,
        string $clientName,
        string $clientLocation,
        string $clientAddress,
        float $total,
        DateTime $dueDate
    ) {
        $this->id = $id;
        $this->clientName = $clientName;
        $this->clientLocation = $clientLocation;
        $this->clientAddress = $clientAddress;
        $this->total = $total;
        $this->dueDate = $dueDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function getClientLocation(): string
    {
        return $this->clientLocation;
    }

    public function getClientAddress(): string
    {
        return $this->clientAddress;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getDueDate(): DateTime
    {
        return $this->dueDate;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(InvoiceItem $item): void
    {
        $this->items[] = $item;
    }
    
    public function removeItem(InvoiceItem $item): void
    {
        $key = array_search($item, $this->items, true);
        if ($key !== false) {
            unset($this->items[$key]);
        }
    }
}