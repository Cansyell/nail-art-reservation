<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable =[
        'customer_name',
        'customer_phone',
        'customer_email',
        'reservation_date',
        'status',
        'service_id',
        'notes',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
