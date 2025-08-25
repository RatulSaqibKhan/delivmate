<?php

namespace App\Services;

use App\Domain\Geo\Interfaces\GeoServiceInterface;
use App\Models\Restaurant;

class ZoneService
{
    public function __construct(private GeoServiceInterface $geo) {}

    public function isDeliverable(Restaurant $r, float $lat, float $lng): bool
    {
        $zones = cache()->remember("rz:{$r->id}", 600, fn() => $r->deliveryZones()->get());
        foreach ($zones as $z) {
            // bbox prefilter
            if ($z->bbox_min_lat && $lat < $z->bbox_min_lat) continue;
            if ($z->bbox_max_lat && $lat > $z->bbox_max_lat) continue;
            if ($z->bbox_min_lng && $lng < $z->bbox_min_lng) continue;
            if ($z->bbox_max_lng && $lng > $z->bbox_max_lng) continue;
            if ($this->geo->pointInZone($lat, $lng, $z)) return true;
        }
        return false;
    }
}
