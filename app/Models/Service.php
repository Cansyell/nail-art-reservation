<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name','description','price','duration_minutes','photo','category'];
    public function transaction_detail()
    {
        return $this->hasMany(TransakctionDetail::class);
    }
}
