<?php

namespace MpwarFramework\Component\Routes;

use Symfony\Component\Yaml\Parser;

class yamlFileReader implements routesFileReader
{
    private $fileToRead;

    public function __construct($fileToRead)
    {
        $this->fileToRead = $fileToRead;
    }

    public function readFile()
    {
        $yaml = new Parser();
        return $yaml->parse(file_get_contents($this->fileToRead));
    }
}

