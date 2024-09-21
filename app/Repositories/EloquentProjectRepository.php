<?php
namespace App\Repositories;

use App\Models\Image;
use App\Models\Project as EloquentProject;
use App\Traits\UplodeImagesTrait;
use Domain\Entities\Project;
use Domain\Repositories\ProjectRepositoryInterface;

class EloquentProjectRepository implements ProjectRepositoryInterface
{
    use UplodeImagesTrait; // Use the trait

    public function find(int $id): ?Project
    {
        $eloquentProject = EloquentProject::with('images')->find($id);
        return $eloquentProject ? $this->toDomain($eloquentProject) : null;
    }

    public function all(): array
    {
        $eloquentProjects = EloquentProject::with('images')->get();
        return $eloquentProjects->map(function ($eloquentProject) {
            return $this->toDomain($eloquentProject);
        })->toArray();
    }

    public function getAll(): array
    {
        // Implementation for getAll method
        return $this->all(); // Reusing the existing all() method implementation
    }

    public function create(Project $project): bool
    {
        $eloquentProject = new EloquentProject([
            'name' => $project->getName(),
            'description' => $project->getDescription(),
            'status' => $project->getStatus(),
            'category_id' => $project->getCategoryId(),
        ]);

        if ($eloquentProject->save()) {
            $this->saveImages($eloquentProject, $project->getImages());
            return true;
        }

        return false;
    }
    public function update(Project $project): bool
    {
        $eloquentProject = EloquentProject::find($project->getId());

        if ($eloquentProject) {
            $eloquentProject->name = $project->getName();
            $eloquentProject->description = $project->getDescription();
            $eloquentProject->status = $project->getStatus();
            $eloquentProject->category_id = $project->getCategoryId();

            // Handle image uploads
            $this->saveImages($eloquentProject, $project->getImages());

            return $eloquentProject->save();
        }

        return false;
    }

    public function delete(int $id): bool
    {
        $eloquentProject = EloquentProject::find($id);

        if ($eloquentProject) {
            // Delete associated images
            $this->deleteImages($eloquentProject, 'images');
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
            $eloquentProject->category_id,
            $eloquentProject->created_at,
            $eloquentProject->updated_at,
            $eloquentProject->images->pluck('url')->toArray() // Assuming images are stored with a 'path' column
        );
    }
    private function saveImages(EloquentProject $eloquentProject, array $images): void
    {
        foreach ($images as $imageFile) {
            if ($imageFile instanceof \Illuminate\Http\UploadedFile) {
                // Store the image and get the path
                $imagePath = $imageFile->store('projects', 'public');
    
                // Create a new Image instance and associate it with the project
                $image = new Image();
                $image->url = $imagePath;
                $image->imageable_id = $eloquentProject->id;
                $image->imageable_type = get_class($eloquentProject); // Set the related model's class name
    
                // Save the image to the database
                $image->save();
            }
        }
    }
    
    
}
