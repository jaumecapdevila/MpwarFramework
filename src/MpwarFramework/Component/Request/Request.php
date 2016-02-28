<?php

namespace MpwarFramework\Component\Request;


class Request
{
    private $method;
    private $path;
    private $session;
    private $cookies;
    private $server;
    private $get;
    private $post;

    function __construct()
    {
        $this->session = $this->setSession();
        $this->cookies = $_COOKIE;
        $this->server = $_SERVER;
        $this->method = $this->setMethod();
        $this->path = $this->setURI();
        $this->get = $_GET;
        $this->post = $_POST;
    }

    private function setMethod()
    {
        return $this->server['REQUEST_METHOD'];
    }

    private function setURI()
    {
        return $this->server['REQUEST_URI'];
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

    function setSession()
    {
        return session_status() === PHP_SESSION_ACTIVE ? $_SESSION : false;
    }
}