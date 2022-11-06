<?php

namespace App\Services\UserAgentClient;

use WhichBrowser\Parser;

class WhichBrowserService implements UserAgentClientServiceInterface
{
    protected $_parser;

    public function __construct(){
        $this->_parser = new Parser(getallheaders());
    }

    public function parse(): void
    {}

    public function getBrowser(): string
    {
        return $this->_parser->browser->toString();
    }

    public function getOS(): string
    {
        return $this->_parser->os->toString();
    }
}
