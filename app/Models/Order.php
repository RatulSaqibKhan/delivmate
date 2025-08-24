<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $table = 'orders';

    protected $fillable = [
        'restaurant_id',
        'customer_id',
        'delivery_address',
        'lat',
        'lng',
        'status',
        'delivery_man_id',
        'assignment_expires_at',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }

    public function deliveryMan() {
        return $this->belongsTo(DeliveryMan::class);
    }
}
