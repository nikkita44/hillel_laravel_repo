<?php

namespace App\Jobs;

use App\Models\Visit;
use App\Services\Geo\GeoServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserAgentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $ip;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $ip)
    {
        $this->ip = $ip;
    }

    public function handle(GeoServiceInterface $reader)
    {
        $reader->parse($this->ip);
        $isoCode = $reader->getIsoCode();
        $continent = $reader->getContinent();

        if(!empty($isoCode) && !empty($continent)){
            Visit::create([
                'ip' => $this->ip,
                'iso_code' => $isoCode,
                'continent_code' => $continent,
                'browser' => 'unidentified',
                'os' => 'unidentified',
            ]);
        }
    }
}
