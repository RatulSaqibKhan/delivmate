<?php

namespace App\Services;

use App\Models\DeliveryMan;

class AssignmentService
{
    public function findNearestAvailable(float $lat, float $lng, int $radiusM = 5000): ?DeliveryMan
    {
        $R = 6371000; // meters
        return DeliveryMan::query()
            ->where(['is_available' => 1, 'status' => 'available'])
            ->where('last_seen_at', '>=', now()->subMinutes(2))
            ->select('*')
            ->selectRaw("$R * ACOS(LEAST(1, COS(RADIANS(?))*COS(RADIANS(lat))*COS(RADIANS(lng)-RADIANS(?)) + SIN(RADIANS(?))*SIN(RADIANS(lat)))) AS distance_m", [$lat, $lng, $lat])
            ->having('distance_m', '<=', $radiusM)
            ->orderBy('distance_m')
            ->first();
    }
    
    public function tryReserve(DeliveryMan $dm): bool
    {
        return DeliveryMan::where('id', $dm->id)
            ->where('status', 'available')
            ->update(['status' => 'reserved']) === 1;
    }

    public function releaseReservation(DeliveryMan $dm): void
    {
        DeliveryMan::where('id', $dm->id)->where('status', 'reserved')->update(['status' => 'available']);
    }
}
