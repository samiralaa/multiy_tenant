<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestPrice extends Model
{
    use HasFactory;
    protected $connection = 'tenant';
    protected $table ='request_prices';

    protected $fillable = [
        'name',           // Your Name
        'phone',               // Your Phone Number
        'email',               // Your Email
        'service',             // What services may we assist you with? (Design)
        'project_type',        // Project Type (Corporate)
        'project_area',        // Project Area (100 M)
        'project_address',     // Project Address
        'client_requirements'  // Client Requirements
    ];
}
