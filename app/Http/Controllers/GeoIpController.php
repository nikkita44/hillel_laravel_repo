<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Services\Geo\GeoServiceInterface;
use App\Services\UserAgentClient\UserAgentClientServiceInterface;
use GeoIp2\Database\Reader;

class GeoIpController extends Controller
{
    public function index(GeoServiceInterface $reader, UserAgentClientServiceInterface $uaclient)
    {
        $ip = request()->ip();
        //$ip = '46.33.39.152';
        $ip = '104.101.112.0';

        $reader->parse($ip);
        $isoCode = $reader->getIsoCode();
        $continent = $reader->getContinent();

        $uaclient->parse();
        $browser = $uaclient->getBrowser();
        $os = $uaclient->getOS();

        if(!empty($isoCode) && !empty($continent)){
            Visit::create([
                'ip' => $ip,
                'iso_code' => $isoCode,
                'continent_code' => $continent,
                'browser' => $browser,
                'os' => $os,
            ]);
        }
    }

}

