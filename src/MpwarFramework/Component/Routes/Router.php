<?php

namespace MpwarFramework\Component\Routes;

use MpwarFramework\Component\Routes\readerFactory;
use MpwarFramework\Component\Request\Request;

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
            if ($this->validRoute($route, $request->getPath())) {
                $params = $this->getRouteParams($route, $request->getPath());
                if ($params === false)
                {
                    return false;
                }
                $routeInformation["route"] = $params;
                $routeInformation["params"] = $params;
                $routeInformation["controller"] = $route["controller"];
                $routeInformation["action"] = $route["action"];
                return $routeInformation;
            }
        }
        return false;
    }

    private function validRoute($route, $requestedRoute)
    {

        $separatedRoute = explode("/", $route["path"]);
        $separatedRequestRoute = explode("/", $requestedRoute);
        $paramPosition = 0;

        foreach ($separatedRoute as $param) {
            if (strpos($param, '{') === false) {
                if ($param !== $separatedRequestRoute[$paramPosition]) {
                    return false;
                }
            }
            $paramPosition++;
        }
       return true;
    }

    private function getRouteParams($route, $requestedRoute)
    {
        $routeParams = array();
        $separatedRoute = explode("/", $route["path"]);
        $separatedRequestRoute = explode("/", $requestedRoute);
        if ($this->differentPathArguments($separatedRoute,$separatedRequestRoute))
        {
            return false;
        }
        $paramPosition = 0;
        foreach ($separatedRoute as $param) {
            if (strpos($param, '{') !== false) {
                $paramName = $this->getParamName($param);
                $routeParams[$paramName] = $separatedRequestRoute[$paramPosition];
            }
            $paramPosition++;
        }
        return $routeParams;
    }

    private function getParamName($param)
    {
        return str_replace(str_split('{}'), '', $param);
    }

    private function differentPathArguments($separatedRoute,$separatedRequestRoute){
        $routeNumParams = count($separatedRoute);
        $requestedRouteNumParams = count($separatedRequestRoute);
        return $routeNumParams != $requestedRouteNumParams;
    }
}

