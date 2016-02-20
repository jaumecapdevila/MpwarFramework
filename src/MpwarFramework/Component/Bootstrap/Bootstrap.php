<?php

namespace MpwarFramework\Component\Bootstrap;

use MpwarFramework\Component\Routes\yamlFileReader;
use MpwarFramework\Component\Routes\Router;
use MpwarFramework\Component\Routes\Dispatcher;
use MpwarFramework\Component\Routes\Request;

class Bootstrap
{   
    private $environment;
    private $fileExtension;

    public function __construct($environment,$fileExtension)
    {
        $this->environment = $environment;
        $this->fileExtension = $fileExtension;
    }

    public function execute (Request $request) {
        $router = new Router($this->fileExtension,'../app/Routing.'.$this->fileExtension);
        $dispatcher = new Dispatcher($router);
        $dispatcher->handle($request);
    }
}
