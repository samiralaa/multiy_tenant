<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\StoreSocialMediaRequest;
use App\Http\Requests\Setting\UpdateSocialMediaRequest;
use App\Services\Setting\SocialMediaService;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{

    protected $socialMediaLinkService;

    public function __construct(SocialMediaService $socialMediaLinkService)
    {
        $this->socialMediaLinkService = $socialMediaLinkService;
    }

    public function index()
    {
        $socialMediaLinks = $this->socialMediaLinkService->getAllSocialMedia();
        return response()->json($socialMediaLinks);
    }

    public function show($id)
    {
        $socialMediaLink = $this->socialMediaLinkService->getSocialMediaById($id);

        if (!$socialMediaLink) {
            return response()->json(['message' => 'Social media link not found'], 404);
        }

        return response()->json($socialMediaLink);
    }

    public function store(StoreSocialMediaRequest $request)
    {
        $data = $request->validated();

        $socialMediaLink = $this->socialMediaLinkService->createSocialMedia($data);

        return response()->json($socialMediaLink, 201);
    }

    public function update(UpdateSocialMediaRequest $request, $id)
    {
        $data = $request->all(); 

        $socialMediaLink = $this->socialMediaLinkService->updateSocialMedia($id, $data);
    
        if (!$socialMediaLink) {
            return response()->json(['message' => 'Social media link not found or update failed'], 404);
        }
    
        return response()->json($socialMediaLink);
    }

    public function destroy($id)
    {
        $deleted = $this->socialMediaLinkService->deleteSocialMedia($id);

        if (!$deleted) {
            return response()->json(['message' => 'Social media link not found or delete failed'], 404);
        }

        return response()->json(['message' => 'Social media link deleted successfully']);
    }
}
