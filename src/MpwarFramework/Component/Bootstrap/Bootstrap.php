<?php

namespace MpwarFramework\Component\Bootstrap;

use MpwarFramework\Component\Routes\Router;
use MpwarFramework\Component\Routes\Dispatcher;
use MpwarFramework\Component\Request\Request;
use MpwarFramework\Component\Response\htmlResponse;
use MpwarFramework\Component\ServiceContainer\ServiceContainer;


class Bootstrap
{
    private $environment;
    private $fileExtension;

    public function __construct()
    {
        $this->environment = "PROD";
        $this->fileExtension = "yml";
        ServiceContainer::getInstance();
    }

    public function setEnvironment($environment)
    {
        $this->environment = $environment;
    }

    public function execute(Request $request)
    {
        $dispatcher = ServiceContainer::getInstanceOf("Dispatcher");
        $controllerInfo = $dispatcher->handle($request);

        if (!$controllerInfo) {
            $response = ServiceContainer::getInstanceOf("htmlResponse");
            $response->setContent('<h1>Page not found</h1>');
            $response->setStatusCode($response::HTTP_NOT_FOUND);
            $response->Send();
        } else {
            $controller = new $controllerInfo["controller"]();
            $controller->$controllerInfo["action"]($controllerInfo["params"]);
        }
    }
}

