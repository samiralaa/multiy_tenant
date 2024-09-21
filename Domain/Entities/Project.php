<?php

namespace Domain\Entities;
use Spatie\Translatable\HasTranslations;

class Project
{
    use HasTranslations;

    private $id;
    private $name; // Should be an array for translations
    private $description; // Should be an array for translations
    private $status;
    private $created_at;
    private $updated_at;
    private $category_id;
    private $images;

    public $translatable = ['name', 'description'];

    public function __construct(
        int $id,
        array $name,
        array $description,
        string $status,
        int $category_id,
        \DateTime $created_at,
        \DateTime $updated_at,
        array $images = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->category_id = $category_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->images = $images;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): array
    {
        return $this->name;
    }

    public function getDescription(): array
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCategoryId(): int
    {
        return $this->category_id; // Ensure this is always an integer
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    // Setter methods for mutable properties
    public function setName(array $name): void // Accept array for translations
    {
        $this->name = $name;
    }

    public function setDescription(array $description): void // Accept array for translations
    {
        $this->description = $description;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    public function setCreatedAt(\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt(\DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function setImages(array $images): void
    {
        $this->images = $images;
    }
}
