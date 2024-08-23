<?php

// domain/Repositories/UserRepositoryInterface.php
namespace Domain\Repositories;

use Domain\Entities\User;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;
    public function findByEmail(string $email): ?User;
    public function save(User $user): void;
    public function update(User $user): void;
    public function delete(int $id): void;
}
