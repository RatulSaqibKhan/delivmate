<?php

namespace App\Providers;

use App\Domain\Geo\Interfaces\GeoServiceInterface;
use App\Domain\Geo\Services\BasicGeoService;
use App\Models\PersonalAccessToken;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        $this->app->bind(GeoServiceInterface::class, BasicGeoService::class);
    }
}
