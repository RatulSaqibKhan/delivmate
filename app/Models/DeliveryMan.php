<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMan extends Model
{
    use HasFactory;
    
    protected $table = 'delivery_men';

    protected $fillable = [
        'user_id',
        'phone',
        'is_available',
        'status',
        'lat',
        'lng',
        'last_seen_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'delivery_man_id', 'id');
    }
}
