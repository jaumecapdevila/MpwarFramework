<?php

namespace MpwarFramework\Component\Routes;

class Request
{
    private $method;
    private $path;
    private $session;
    private $cookies;
    private $server;

    function __construct($method, $path)
    {
        $this->method = $method;
        $this->path = $path;
        $this->session = $_SESSION;
        $this->cookies = $_COOKIES;
        $this->server = $_SERVER;
    }

    function getMethod()
    {
        return $this->method;
    }

    function getPath()
    {
        return $this->path;
    }

    function getSession()
    {
        return $this->session;
    }

    function getCookies()
    {
        return $this->session;
    }

    function getSever()
    {
        return $this->server;
    }
}
