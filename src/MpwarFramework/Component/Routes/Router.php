<?php

namespace MpwarFramework\Component\Routes;

use MpwarFramework\Component\Routes\readerFactory;

class Router
{
    private $readMethod;
    private $pathToRoutesFile;

    public function __construct($readMethod,$pathToRoutesFile)
    {
        $this->pathToRoutesFile = $pathToRoutesFile;
        $this->readMethod = $readMethod;
    }

    public function matchRoute(Request $request)
    {
        $reader =  readerFactory::instantiateReader($this->readMethod,$this->pathToRoutesFile);
        $routes = $reader->readFile();

        foreach ($routes as $route) {
            if ($route["path"] == $request->getPath()) {
                echo "Route found";
            }
        }

        return false;
    }
}
