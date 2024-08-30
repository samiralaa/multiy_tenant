<?php

namespace Domain\Repositories;

use Domain\Entities\Project;

interface ProjectRepositoryInterface
{
    public function find(int $id): ?Project;

    public function getAll(): array;

    public function create(Project $project): bool;

    public function update(Project $project): bool;

    public function delete(int $id): bool;
}
