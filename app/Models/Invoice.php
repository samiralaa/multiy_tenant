<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id', 'invoice_date', 'total_amount', 'status',
    ];

    // An invoice belongs to one client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // An invoice can have multiple items
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
