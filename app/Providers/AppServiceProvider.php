<?php

namespace App\Providers;

use App\Services\Geo\GeoServiceInterface;
use App\Services\Geo\IpApiGeoService;
use App\Services\Geo\MaxMindService;
use App\Services\UserAgentClient\PhpUserAgentService;
use App\Services\UserAgentClient\UserAgentClientServiceInterface;
use App\Services\UserAgentClient\WhichBrowserService;
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

        $this->app->singleton(UserAgentClientServiceInterface::class, function(){
            //return new PhpUserAgentService();
            return new WhichBrowserService();
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
