<?php

namespace MpwarFramework\Component\Routes;

class xmlFileReader implements routesFileReader
{
    private $fileToRead;

    public function __construct($fileToRead)
    {
        $this->fileToRead = $fileToRead;
    }

    public function readFile()
    {
        $routes = simplexml_load_file($this->fileToRead);
         foreach ( (array) $routes as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;
        var_dump($out);
    }
}
