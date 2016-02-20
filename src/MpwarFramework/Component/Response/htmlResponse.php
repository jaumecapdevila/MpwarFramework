<?php
namespace MpwarFramework\Component\Response;

class htmlResponse
{
    private $httpRequest;

    public function __construct($httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }

    public function generateResponse()
    {

    }
}

