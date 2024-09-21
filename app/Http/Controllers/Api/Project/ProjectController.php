<?php

namespace App\Http\Controllers\Api\Project;

use Domain\Entities\Project;
use App\Http\Requests\Project\ProjectRequest;
use Domain\Repositories\ProjectRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProjectController
{
    private $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function index(): JsonResponse
    {
        $projects = $this->projectRepository->getAll();
        return response()->json($projects);
    }

    public function show(int $id): JsonResponse
    {
        $project = $this->projectRepository->find($id);
        if ($project) {
            return response()->json($project);
        }
        return response()->json(['message' => 'Project not found'], 404);
    }

    public function store(ProjectRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $translations = [
            'name' => [
                'en' => $validated['name_en'],
                'ar' => $validated['name_ar'],
            ],
            'description' => [
                'en' => $validated['description_en'],
                'ar' => $validated['description_ar'],
            ],
        ];

        $project = new Project(
            0,
            $translations['name'],
            $translations['description'],
            $validated['status'],
            $validated['category_id'],
            new \DateTime(),
            new \DateTime(),
            $request->file('images', [])
        );

        $result = $this->projectRepository->create($project);
        if ($result) {
            return response()->json(['message' => 'Project created successfully'], 201);
        }

        return response()->json(['message' => 'Failed to create project'], 500);
    }

    public function update(ProjectRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        $translations = [
            'name' => [
                'en' => $validated['name_en'],
                'ar' => $validated['name_ar'],
            ],
            'description' => [
                'en' => $validated['description_en'],
                'ar' => $validated['description_ar'],
            ],
        ];

        $project = $this->projectRepository->find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $updatedProject = new Project(
            $id,
            $translations['name'],
            $translations['description'],
            $validated['status'],
            $validated['category_id'],
            $project->getCreatedAt(),
            new \DateTime(),
            $request->file('images', [])
        );

        $result = $this->projectRepository->update($updatedProject);
        if ($result) {
            return response()->json(['message' => 'Project updated successfully']);
        }

        return response()->json(['message' => 'Failed to update project'], 500);
    }

    public function destroy(int $id): JsonResponse
    {
        $result = $this->projectRepository->delete($id);
        if ($result) {
            return response()->json(['message' => 'Project deleted successfully']);
        }

        return response()->json(['message' => 'Failed to delete project'], 500);
    }
}
