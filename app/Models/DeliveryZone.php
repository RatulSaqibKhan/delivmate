<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryZone extends Model
{
    use HasFactory;

    protected $table = 'delivery_zones';

    protected $fillable = [
        'restaurant_id',
        'type',
        'geojson',
        'center_lat',
        'center_lng',
        'radius_m',
        'bbox_min_lat',
        'bbox_min_lng',
        'bbox_max_lat',
        'bbox_max_lng',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'geojson' => 'array',
        ];
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
