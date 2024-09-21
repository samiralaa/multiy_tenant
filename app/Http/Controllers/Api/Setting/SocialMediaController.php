<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\StoreSocialMediaRequest;
use App\Http\Requests\Setting\UpdateSocialMediaRequest;
use App\Services\Setting\SocialMediaService;
use Illuminate\Http\JsonResponse;

class SocialMediaController extends Controller
{
    protected SocialMediaService $socialMediaService;

    public function __construct(SocialMediaService $socialMediaService)
    {
        $this->socialMediaService = $socialMediaService;
    }

    /**
     * Display a listing of social media links.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
       
        $socialMediaLinks = $this->socialMediaService->getAllSocialMedia();
        return response()->json($socialMediaLinks);
    }

    /**
     * Display the specified social media link.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $socialMediaLink = $this->socialMediaService->getSocialMediaById($id);

        if (!$socialMediaLink) {
            return response()->json(['message' => 'Social media link not found'], 404);
        }

        return response()->json($socialMediaLink);
    }

    /**
     * Store a newly created social media link.
     *
     * @param StoreSocialMediaRequest $request
     * @return JsonResponse
     */
    public function store(StoreSocialMediaRequest $request): JsonResponse
    {
        $data = $request->validated();
        $socialMediaLink = $this->socialMediaService->createSocialMedia($data);

        return response()->json($socialMediaLink, 201);
    }

    /**
     * Update the specified social media link.
     *
     * @param UpdateSocialMediaRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateSocialMediaRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        $socialMediaLink = $this->socialMediaService->updateSocialMedia($id, $data);

        if (!$socialMediaLink) {
            return response()->json(['message' => 'Social media link not found or update failed'], 404);
        }

        return response()->json($socialMediaLink);
    }

    /**
     * Remove the specified social media link.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->socialMediaService->deleteSocialMedia($id);

        if (!$deleted) {
            return response()->json(['message' => 'Social media link not found or delete failed'], 404);
        }

        return response()->json(['message' => 'Social media link deleted successfully']);
    }
}
