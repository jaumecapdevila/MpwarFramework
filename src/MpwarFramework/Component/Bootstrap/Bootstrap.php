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
            $controllerPath = 'MpwarApp\\' . $controllerInfo["controller"][0] . '\\Controller\\' .  $controllerInfo["controller"][1];
            $controller = new $controllerPath();
            $controller-> $controllerInfo["controller"][2]($controllerInfo["params"]);
        }
    }
}
