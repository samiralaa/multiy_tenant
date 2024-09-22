<?php

namespace App\Http\Controllers\Api\RequestPrice;
use App\Http\Requests\RequestPriceRequest; // Create this request class for validation
use Domain\Repositories\RequestPriceRepositoryInterface;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestPriceController extends Controller
{
    private $repository;

    public function __construct(RequestPriceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(): JsonResponse
    {
        $requestPrices = $this->repository->all();

        return response()->json($requestPrices);
    }
    public function store(RequestPriceRequest $request): JsonResponse
    {
        $requestPrice = new \Domain\Entities\RequestPrice(
            $request->input('name'),
            $request->input('phone'),
            $request->input('email'),
            $request->input('service'),
            $request->input('project_type'),
            $request->input('project_area'),
            $request->input('project_address'),
            $request->input('client_requirements')
        );

        $savedRequestPrice = $this->repository->save($requestPrice);
return response()->json(['message' => 'Request created successfully'], 201);
        return response()->json($savedRequestPrice, 201);
    }

    public function show(int $id): JsonResponse
    {
        $requestPrice = $this->repository->findById($id);
        if (!$requestPrice) {
            return response()->json(['message' => 'Request not found'], 404);
        }

        return response()->json($requestPrice);
    }

    public function update(RequestPriceRequest $request, int $id): JsonResponse
    {
        $requestPrice = new \Domain\Entities\RequestPrice(
            $request->input('name'),
            $request->input('phone'),
            $request->input('email'),
            $request->input('service'),
            $request->input('project_type'),
            $request->input('project_area'),
            $request->input('project_address'),
            $request->input('client_requirements'),
            $id
        );

        if ($this->repository->update($requestPrice)) {
            return response()->json(['message' => 'Request updated successfully']);
        }

        return response()->json(['message' => 'Request not found or update failed'], 404);
    }

    public function destroy(int $id): JsonResponse
    {
        if ($this->repository->delete($id)) {
            return response()->json(['message' => 'Request deleted successfully']);
        }

        return response()->json(['message' => 'Request not found'], 404);
    }
}
