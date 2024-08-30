<?php
namespace Domain\Entities;

class Project
{
    private $id;
    private $name;
    private $description;
    private $status;
    private $created_at;
    private $updated_at;
    private $category_id;
    private $images; // Array of image URLs

    public function __construct(
        int $id,
        string $name,
        string $description,
        string $status,
        int $category_id, // Ensure category_id is an integer
        \DateTime $created_at,
        \DateTime $updated_at,
        array $images = [] // Initialize images as an array
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
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

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
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
