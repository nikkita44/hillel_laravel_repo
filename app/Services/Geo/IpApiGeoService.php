<?php

namespace App\Services\Geo;

use GeoIp2\Database\Reader;
use GeoIp2\Model\Country;
use Illuminate\Support\Facades\Http;

class IpApiGeoService implements GeoServiceInterface
{
    /** @var array */
    protected $_data;

    public function parse(string $ip): void
    {
        $responce = Http::get($this->getUrl($ip));
        $this->_data = $responce->json();
    }

    /**
     * @return string|null
     */
    public function getIsoCode(): ?string
    {
        return $this->_data['countryCode'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getContinent(): ?string
    {
        return $this->_data['continentCode'] ?? null;
    }

    /**
     * @param string $ip
     * @return string
     */
    protected function getUrl(string $ip): string
    {
        $url = 'http://ip-api.com/json/' . $ip;
        $parameters = http_build_query([
            'fields' => 'continentCode,countryCode,query'
        ]);
        return $url . '?' . $parameters;
    }
}
