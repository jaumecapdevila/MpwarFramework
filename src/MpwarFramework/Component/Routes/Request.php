<?php

namespace MpwarFramework\Component\Routes;


class Request
{
    private $method;
    private $path;

    function __construct($method, $path)
    {
        $this->method = $method;
        $this->path = $path;
    }

    function getMethod()
    {
        return $this->method;
    }

    function getPath()
    {
        return $this->path;
    }
}
