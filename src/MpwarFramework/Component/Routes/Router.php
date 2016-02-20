<?php

namespace MpwarFramework\Component\Routes;

use MpwarFramework\Component\Routes\readerFactory;

class Router
{
    private $fileExtension;
    private $pathToFile;

    public function __construct($fileExtension, $pathToFile)
    {
        $this->pathToFile = $pathToFile;
        $this->fileExtension = $fileExtension;
    }

    public function matchRoute(Request $request)
    {
        $reader = readerFactory::instantiateReader($this->fileExtension, $this->pathToFile);
        $routes = $reader->readFile();

        foreach ($routes as $route) {

            if ($route["path"] == $request->getPath()) {
                return $this->getControllerInformation($route["defaults"]);
            }
        }

        return false;
    }

    private function getControllerInformation($route)
    {
        $controllerString = $route["_controller"];

        return explode(":",$controllerString);
    }

}

