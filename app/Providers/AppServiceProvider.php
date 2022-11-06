<?php

namespace App\Providers;

use App\Services\Geo\GeoServiceInterface;
use App\Services\Geo\IpApiGeoService;
use App\Services\Geo\MaxMindService;
use Nick44\UserAgent\PhpUserAgentService;
use Nick44\UserAgent\UserAgentClientServiceInterface;
use Nick44\UserAgent\WhichBrowserService;
use GeoIp2\Database\Reader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GeoServiceInterface::class, function(){
            //return new MaxMindService();
            return new IpApiGeoService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
