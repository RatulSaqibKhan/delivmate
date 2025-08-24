<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAssignmentAttempt extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id',
        'delivery_man_id',
        'distance_m',
        'result',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function deliveryMan()
    {
        return $this->belongsTo(DeliveryMan::class);
    }
}
