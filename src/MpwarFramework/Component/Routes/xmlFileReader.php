<?php

namespace MpwarFramework\Component\Routes;
use Symfony\Component\DomCrawler\Crawler;

class xmlFileReader implements routesFileReader
{
    private $fileToRead;

    public function __construct($fileToRead)
    {
        $this->fileToRead = $fileToRead;
    }

    public function readFile()
    {
    
    }
}
