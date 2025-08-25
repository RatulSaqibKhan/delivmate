<?php

namespace App\Domain\Geo\Interfaces;

interface GeoServiceInterface
{
    public function distanceMeters(float $lat1, float $lng1, float $lat2, float $lng2): float;
    
    public function pointInCircle(float $lat, float $lng, float $cLat, float $cLng, int $radiusM): bool;
    
    /** @param array<array{0:float,1:float}> $polygonLngLat */
    public function pointInPolygon(float $lat, float $lng, array $polygonLngLat): bool;
    
    public function pointInZone(float $lat, float $lng, \App\Models\DeliveryZone $zone): bool;
}
