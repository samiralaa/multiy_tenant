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

    public function save(Project $project): void
    {
        DB::transaction(function () use ($project) {
            $eloquentProject = EloquentProject::find($project->getId());

            if ($eloquentProject) {
                $eloquentProject->update([
                    'name' => $project->getName(),
                    'description' => $project->getDescription(),
                    'status' => $project->getStatus(),
                    'start_date' => $project->getStartDate(),
                    'end_date' => $project->getEndDate(),
                ]);
            } else {
                EloquentProject::create([
                    'name' => $project->getName(),
                    'description' => $project->getDescription(),
                    'status' => $project->getStatus(),
                    'start_date' => $project->getStartDate(),
                    'end_date' => $project->getEndDate(),
                ]);
            }
        });
    }

    public function delete(int $id): void
    {
        EloquentProject::destroy($id);
    }

    public function findById(int $id): ?Project
    {
        return $this->find($id);
    }

    public function update(Project $project): void
    {
        $this->save($project);
    }

    public function findAll(): array
    {
        $eloquentProjects = EloquentProject::all();
        return $eloquentProjects->map(function ($eloquentProject) {
            return $this->toDomain($eloquentProject);
        })->toArray();
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
