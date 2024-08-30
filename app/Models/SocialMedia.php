<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    protected $connection = 'tenant';
    protected $table ='social_media';
    protected $fillable = ['name', 'icon', 'url'];

    public $timestamps = false;


    public function social_media_links()
    {
        return $this->hasMany(SocialMediaLink::class,'social_media_id', 'id');
    }
}
