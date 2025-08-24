<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    
    protected $table = 'restaurants';

    protected $fillable = [
        'name',
        'user_id',
        'address',
        'lat',
        'lng',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function zones()
    {
        return $this->hasMany(DeliveryZone::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
