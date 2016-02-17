<?php

namespace MpwarFramework\Component\Bootstrap;


class Bootstrap
{   
    private $environment;

    public function __construct($environment)
    {
        $this->environment = $environment;
    }
}
