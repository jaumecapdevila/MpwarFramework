<?php

namespace MpwarFramework\Component\Request;


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
        $this->session = $this->setSession();
        $this->cookies = $_COOKIE;
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
    function setSession () {
        return session_status() === PHP_SESSION_ACTIVE ? $_SESSION : FALSE;
    }
}