<?php

namespace MpwarFramework\Component\ServiceContainer;

use MpwarFramework\Component\Routes\yamlFileReader;


class ServiceContainer
{
    const SERVICES_FILE_PATH = __DIR__ . "/Services.yml";

    private static $instance = null;
    private static $services;

    static public function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ServiceContainer();
        }
        return self::$instance;
    }

    public function __construct()
    {
        if (self::$services === null) {
            $yamelReader = new yamlFileReader(self::SERVICES_FILE_PATH);
            self::$services = $yamelReader->readFile();
        }
    }

    public static function getInstanceOf($service)
    {
        $totalArguments = [];
        $serviceArguments = self::$services["Services"][$service][1];
        $componentNameSpace = self::$services["Services"][$service][0]["class"] . "\\" . $service;

        if ($serviceArguments["arguments"] === null || count($serviceArguments["arguments"]) == 0) {
            $serviceObject = new $componentNameSpace();

        } else {
            $arrayCont = 0;
            foreach ($serviceArguments["arguments"] as $argument) {
                if (self::isAnotherService($argument)) {
                    $serviceToInstantiate = self::getServiceName($argument);
                    $argumentInstance = self::getInstanceOf($serviceToInstantiate);
                    $totalArguments[$argument] = $argumentInstance;
                } else {
                    $totalArguments[$argument] = $serviceArguments["arguments"][$arrayCont];
                }
                $arrayCont++;
            }
            $reflection = new \ReflectionClass($componentNameSpace);
            $serviceObject = $reflection->newInstanceArgs($totalArguments);
        }
        return $serviceObject;
    }

    private static function isAnotherService($argument)
    {
        if (strpos($argument, '@') !== false) {
            return true;
        }
        return false;
    }

    private static function getServiceName ($argument){
        return str_replace("@", "", $argument);
    }
}
