<?php

namespace MpwarFramework\Component\Routes;

use MpwarFramework\Component\Routes\yamlFileReader;

class Router
{
    private $pathToRoutesFile;

    public function __construct($pathToRoutesFile)
    {
        $this->pathToRoutesFile = $pathToRoutesFile;
    }

    public function matchRoute(Request $request)
    {
        $yamlReader = new yamlFileReader($this->pathToRoutesFile);
        $routes = $yamlReader->readFile();


        foreach ($routes as $route) {
            if ($route["path"] == $request->getPath()) {
                echo "Route found";
            }
        }

        return false;
    }
}
