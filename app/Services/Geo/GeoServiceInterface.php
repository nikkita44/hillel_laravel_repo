<?php

namespace App\Services\Geo;

interface GeoServiceInterface
{
    public function parse(string $ip): void;

    public function getIsoCode(): ?string;

    public function getContinent(): ?string;
}
