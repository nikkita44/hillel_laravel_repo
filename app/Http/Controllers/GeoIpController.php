<?php

namespace App\Http\Controllers;

use App\Jobs\TestEmail;
use App\Jobs\UserAgentJob;
use App\Mail\WelcomeMail;
use App\Models\Visit;
use App\Services\Geo\GeoServiceInterface;
//use App\Services\UserAgentClient\UserAgentClientServiceInterface;
use Illuminate\Support\Facades\Mail;
use Nick44\UserAgent\UserAgentClientServiceInterface;

class GeoIpController extends Controller
{
    public function index()
    {
        $mail = (new WelcomeMail('Nick12'))->onQueue('default');
        Mail::to('some@test.com')->queue($mail);

        $ip = '46.33.39.152';

        UserAgentJob::dispatch($ip)->onQueue('parsing');
    }

}

