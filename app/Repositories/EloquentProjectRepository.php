<?php

namespace App\Repositories;

use Domain\Entities\Project;
use Domain\Repositories\ProjectRepositoryInterface;
use App\Models\Project as EloquentProject;
use Illuminate\Support\Facades\DB;

class EloquentProjectRepository implements ProjectRepositoryInterface
{
    public function find(int $id): ?Project
    {
        $eloquentProject = EloquentProject::find($id);
        return $eloquentProject ? $this->toDomain($eloquentProject) : null;
    }

    public function all(): array
    {
        $eloquentProjects = EloquentProject::all();
        return $eloquentProjects->map(function ($eloquentProject) {
            return $this->toDomain($eloquentProject);
        })->toArray();
    }

    public function create(Project $project): bool
    {
        $eloquentProject = new EloquentProject([
            'name' => $project->getName(),
            'description' => $project->getDescription(),
            'status' => $project->getStatus(),
            'start_date' => $project->getStartDate(),
            'end_date' => $project->getEndDate(),
        ]);

        return $eloquentProject->save();
    }

    public function update(Project $project): bool
    {
        $eloquentProject = EloquentProject::find($project->getId());

        if ($eloquentProject) {
            $eloquentProject->name = $project->getName();
            $eloquentProject->description = $project->getDescription();
            $eloquentProject->status = $project->getStatus();
            $eloquentProject->start_date = $project->getStartDate();
            $eloquentProject->end_date = $project->getEndDate();

            return $eloquentProject->save();
        }

        return false;
    }

    public function delete(int $id): bool
    {
        $eloquentProject = EloquentProject::find($id);

        if ($eloquentProject) {
            return $eloquentProject->delete();
        }

        return false;
    }

    private function toDomain(EloquentProject $eloquentProject): Project
    {
        return new Project(
            $eloquentProject->id,
            $eloquentProject->name,
            $eloquentProject->description,
            $eloquentProject->status,
            $eloquentProject->start_date,
            $eloquentProject->end_date,
            $eloquentProject->created_at,
            $eloquentProject->updated_at
        );
    }
}
