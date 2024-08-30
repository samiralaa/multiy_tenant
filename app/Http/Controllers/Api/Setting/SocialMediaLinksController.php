<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\StoreSocialMediaRequest;
use App\Http\Requests\Setting\UpdateSocialMediaRequest;
use App\Services\Setting\SocialMediaLinkService;
use Illuminate\Http\Request;

class SocialMediaLinksController extends Controller
{
    protected $socialMediaLinkService;

    public function __construct(SocialMediaLinkService $socialMediaLinkService)
    {
        $this->socialMediaLinkService = $socialMediaLinkService;
    }

    public function index()
    {
        $socialMediaLinks = $this->socialMediaLinkService->getAllSocialMediaLinks();
        return response()->json($socialMediaLinks);
    }

    public function show($id)
    {
        $socialMediaLink = $this->socialMediaLinkService->getSocialMediaLinkById($id);

        if (!$socialMediaLink) {
            return response()->json(['message' => 'Social media link not found'], 404);
        }

        return response()->json($socialMediaLink);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'social_media_id' => 'required|exists:social_medias,id',
            'social_media_link' => 'required|url|max:255',
        ]);

        $socialMediaLink = $this->socialMediaLinkService->createSocialMediaLink($data);

        return response()->json($socialMediaLink, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'social_media_id' => 'required|exists:social_medias,id',
            'social_media_link' => 'required|url|max:255',
        ]);

        $socialMediaLink = $this->socialMediaLinkService->updateSocialMediaLink($id, $data);

        if (!$socialMediaLink) {
            return response()->json(['message' => 'Social media link not found or update failed'], 404);
        }

        return response()->json($socialMediaLink);
    }

    public function destroy($id)
    {
        $deleted = $this->socialMediaLinkService->deleteSocialMediaLink($id);

        if (!$deleted) {
            return response()->json(['message' => 'Social media link not found or delete failed'], 404);
        }

        return response()->json(['message' => 'Social media link deleted successfully']);
    }
}
