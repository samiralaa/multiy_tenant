<?php

namespace App\Services\Setting;

use App\Models\SocialMedia;
use App\Traits\CrudTrait;

class SocialMediaService
{
    use CrudTrait;

    public function __construct(SocialMedia $socialMedia)
    {
        $this->model = $socialMedia;
    }
    public function getAllSocialMedia()
    {
         return $this->index($this->model,['name', 'id','url','icon']);
    }
    public function getAllwithRelations()
    {
        return $this->model->with('social_media_links')->get();
    }
    public function getSocialMediaById($id)
{
    // Corrected call to the show method
    return $this->show($this->model, $id, ['name', 'id', 'url', 'icon']);
}

    public function createSocialMedia($data)
    {
        return $this->store($data);
    }
    public function updateSocialMedia($id, $data)
    {
        return $this->update($id, $data);
    }
    public function deleteSocialMedia($id)
    {
        return $this->delete($id);
    }
}