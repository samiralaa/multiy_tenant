<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = ['name', 'email', 'phone', 'date', 'time', 'people', 'note'];
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'date' => 'datetime:Y-m-d',
        'time' => 'datetime:H:i',
    ];
}
