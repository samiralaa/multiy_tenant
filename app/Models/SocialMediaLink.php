<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaLink extends Model
{
    use HasFactory;
    protected $connection = 'tenant';
    protected $table ='social_media_links';
    protected $fillable = ['social_media_id','social_media_link'];


    public function social_media()
    {
        return $this->belongsTo(SocialMedia::class,'social_media_id');
    }
}
