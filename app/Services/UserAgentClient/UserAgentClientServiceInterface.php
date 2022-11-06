<?php

namespace App\Services\UserAgentClient;

interface UserAgentClientServiceInterface
{
    public function parse(): void;

    public function getBrowser(): string;

    public function getOS(): string;
}
