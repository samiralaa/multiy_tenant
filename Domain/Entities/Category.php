<?php
 namespace Domain\Entities;

 class Category
 {
     private int $id;
     private string $name;
     private ?string $description;
     private ?\DateTime $created_at;
     private ?\DateTime $updated_at;
     private array $projects;
     public function __construct(int $id, string $name, ?string $description, ?\DateTime $created_at, ?\DateTime $updated_at, array $projects)
     {
         $this->id = $id;
         $this->name = $name;
         $this->description = $description;
         $this->created_at = $created_at;
         $this->updated_at = $updated_at;
         $this->projects = $projects;
     }

     public function getId(): int
     {
         return $this->id;
     }

     public function getName(): string
     {
         return $this->name;
     }

     public function getDescription(): ?string
     {
         return $this->description;
     }

     public function getCreatedAt(): ?\DateTime
     {
         return $this->created_at;
     }

     public function getUpdatedAt(): ?\DateTime
     {
         return $this->updated_at;
     }

     public function getprojects(): array
     {
         return $this->projects;
     }


 }