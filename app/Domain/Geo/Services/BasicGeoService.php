<?php

namespace App\Domain\Geo\Services;

use App\Domain\Geo\Interfaces\GeoServiceInterface;

class BasicGeoService implements GeoServiceInterface
{
    public function distanceMeters(...$args): float
    {
        [$lat1, $lng1, $lat2, $lng2] = $args;
        $R = 6371000;
        $phi1 = deg2rad($lat1);
        $phi2 = deg2rad($lat2);
        $dphi = deg2rad($lat2 - $lat1);
        $dl = deg2rad($lng2 - $lng1);
        $a = sin($dphi / 2) ** 2 + cos($phi1) * cos($phi2) * sin($dl / 2) ** 2;
        return 2 * $R * asin(min(1, sqrt($a)));
    }

    public function pointInCircle($lat, $lng, $cLat, $cLng, $radiusM): bool
    {
        return $this->distanceMeters($lat, $lng, $cLat, $cLng) <= $radiusM;
    }

    public function pointInPolygon($lat, $lng, $poly): bool
    {
        // ray casting; $poly is [[lng,lat],...]
        $inside = false;
        $j = count($poly) - 1;
        for ($i = 0; $i < count($poly); $i++) {
            [$xi, $yi] = [$poly[$i][1], $poly[$i][0]];
            [$xj, $yj] = [$poly[$j][1], $poly[$j][0]];
            $intersect = ((($yi > $lat) != ($yj > $lat)) &&
                ($lng < ($yj - $yi) * ($lat - $xi) / max(1e-12, ($xj - $xi)) + $yi));
            if ($intersect) $inside = !$inside;
            $j = $i;
        }
        return $inside;
    }

    public function pointInZone($lat, $lng, $zone): bool
    {
        if ($zone->type === 'radius') {
            return $this->pointInCircle($lat, $lng, $zone->center_lat, $zone->center_lng, $zone->radius_m);
        }
        $gj = $zone->geojson; // Polygon GeoJSON with coordinates [[[lng,lat],...]]
        $ring = $gj['coordinates'][0] ?? [];
        return $this->pointInPolygon($lat, $lng, $ring);
    }
}
