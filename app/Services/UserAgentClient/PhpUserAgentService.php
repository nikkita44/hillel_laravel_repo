<?php

namespace App\Services\UserAgentClient;

use donatj\UserAgent\UserAgentParser;

class PhpUserAgentService implements UserAgentClientServiceInterface
{
    protected $_parser;
    protected $_data;

    public function __construct(){
        $this->_parser = new UserAgentParser();
    }

    public function parse(): void
    {
        $this->_data = $this->_parser->parse();
    }

    public function getBrowser(): string
    {
        return $this->_data->browser();
    }

    public function getOS(): string
    {
        return $this->_data->platform();
    }
}
