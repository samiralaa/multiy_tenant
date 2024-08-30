<?php

namespace App\Http\Controllers\Api\Project;
use Domain\Entities\Project;


use App\Http\Requests\Project\ProjectRequest;
use App\Models\Category;
use App\Repositories\EloquentProjectRepository;
use Illuminate\Http\Request;

class ProjectController 
{
    protected $projectRepository;

    public function __construct(EloquentProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function index()
    {
        $projects = $this->projectRepository->getAll();
        return response()->json($projects);
    }

    public function show(int $id)
    {
        $project = $this->projectRepository->find($id);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        return response()->json($project);
    }
    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();
    
        // Create a Domain\Entities\Project instance
        $project = new Project(
            0, // Assuming ID is auto-generated
            $validated['name'],
            $validated['description'],
            $validated['status'],
            (int) $validated['category_id'],
            new \DateTime(), // created_at
            new \DateTime(), // updated_at
            $request->file('images') // Pass the images directly
        );
    
        // Pass the Domain\Entities\Project instance to the repository
        $result = $this->projectRepository->create($project);
    
        if ($result) {
            return response()->json(['message' => 'Project created successfully'], 201);
        }
    
        return response()->json(['message' => 'Failed to create project'], 500);
    }
    
    public function update(ProjectRequest $request, int $id)
    {
        $project = $this->projectRepository->find($id);
    
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }
    
        $project->setName($request->input('name'));
        $project->setDescription($request->input('description'));
        $project->setStatus($request->input('status'));
        $project->setCategoryId((int) $request->input('category_id'));
        $project->setImages($request->file('images')); // Pass the images directly
    
        $updated = $this->projectRepository->update($project);
    
        return $updated
            ? response()->json(['message' => 'Project updated successfully'], 200)
            : response()->json(['error' => 'Failed to update project'], 500);
    }
    

    public function destroy(int $id)
    {
        $deleted = $this->projectRepository->delete($id);

        return $deleted
            ? response()->json(['message' => 'Project deleted successfully'], 200)
            : response()->json(['error' => 'Failed to delete project'], 500);
    }
}