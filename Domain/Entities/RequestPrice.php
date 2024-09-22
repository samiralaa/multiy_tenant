<?php

namespace Domain\Entities;

class RequestPrice
{
    private ?int $id;
    private string $name;
    private string $phone;
    private string $email;
    private string $service;
    private string $project_type;
    private string $project_area;
    private string $project_address;
    private string $client_requirements;

    public function __construct(
        string $name,
        string $phone,
        string $email,
        string $service,
        string $project_type,
        string $project_area,
        string $project_address,
        string $client_requirements,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->service = $service;
        $this->project_type = $project_type;
        $this->project_area = $project_area;
        $this->project_address = $project_address;
        $this->client_requirements = $client_requirements;
    }

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getService(): string
    {
        return $this->service;
    }

    public function getProjectType(): string
    {
        return $this->project_type;
    }

    public function getProjectArea(): string
    {
        return $this->project_area;
    }

    public function getProjectAddress(): string
    {
        return $this->project_address;
    }

    public function getClientRequirements(): string
    {
        return $this->client_requirements;
    }

    // Setters
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setService(string $service): void
    {
        $this->service = $service;
    }

    public function setProjectType(string $project_type): void
    {
        $this->project_type = $project_type;
    }

    public function setProjectArea(string $project_area): void
    {
        $this->project_area = $project_area;
    }

    public function setProjectAddress(string $project_address): void
    {
        $this->project_address = $project_address;
    }

    public function setClientRequirements(string $client_requirements): void
    {
        $this->client_requirements = $client_requirements;
    }
}
