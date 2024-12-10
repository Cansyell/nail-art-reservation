<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'reservation_id',
        'service_id',
        'total_amount',
        'discount',
        'final_amount',
        'payment_status',
        'payment_method',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
