<?php

namespace MpwarFramework\Component\Bootstrap;

use MpwarFramework\Component\Routes\Router;
use MpwarFramework\Component\Routes\Dispatcher;
use MpwarFramework\Component\Request\Request;


class Bootstrap
{
    private $environment;
    private $fileExtension;

    public function __construct($environment, $fileExtension)
    {
        $this->environment = $environment;
        $this->fileExtension = $fileExtension;
    }

    public function execute(Request $request)
    {
        $router = new Router($this->fileExtension, '../app/Routing.' . $this->fileExtension);
        $dispatcher = new Dispatcher($router);
        $controllerInfo = $dispatcher->handle($request);
        if (!$controllerInfo) {
            echo "Route not found";
        } else {
            $controller = new $controllerInfo["controller"]();
            $controller-> $controllerInfo["action"]($controllerInfo["params"]);
        }
    }
}
