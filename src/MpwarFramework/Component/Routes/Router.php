<?php

namespace MpwarFramework\Component\Routes;
use MpwarFramework\Component\Routes\yamlFileReader;


class Router
{
    /*private $routes = [
        'get' => [],
        'post' => []
    ];*/
    private $pathToRoutesFile;

    public function __construct($pathToRoutesFile)
    {
        $this->pathToRoutesFile = $pathToRoutesFile;
    }

    /*public function addGetRoute($pattern, callable $handler)
    {
        $this->routes['get'][$pattern] = $handler;
        return $this;
    }

    public function addPostRoute($pattern, callable $handler)
    {
        $this->routes['post'][$pattern] = $handler;
        return $this;
    }*/

    public function matchRoute(Request $request)
    {
        $yamlReader = new yamlFileReader($this->pathToRoutesFile);
        $routes = $yamlReader->readFile();


        foreach($routes as $route) {
            if($route["path"] == $request->getPath()) {
                echo "Route found";
            }
        }

        return false;
        /*$method = strtolower($request->getMethod());
        if (!isset($this->routes[$method])) {
            return false;
        }

        $path = $request->getPath();
        foreach ($this->routes[$method] as $pattern => $handler) {
            if ($pattern === $path) {
                return $handler;
            }
        }

        return false;*/
    }


}