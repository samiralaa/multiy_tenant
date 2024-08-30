<?php

namespace App\Services\Setting;

use App\Models\SocialMediaLink;
use App\Traits\CrudTrait;

class SocialMediaLinkService
{
    use CrudTrait;

    public function __construct(SocialMediaLink $socialMediaLink)
    {
        $this->model = $socialMediaLink;
    }

    public function getAllSocialMediaLinks()
    {
        return $this->model->with('social_media')->get();
    }

    public function getSocialMediaLinkById($id)
    {
        return $this->model->with('social_media')->find($id);
    }

    public function createSocialMediaLink(array $data)
    {
        return $this->store($data);
    }

    public function updateSocialMediaLink($id, array $data)
    {
        return $this->update($id, $data);
    }

    public function deleteSocialMediaLink($id)
    {
        return $this->delete($id);
    }
}
