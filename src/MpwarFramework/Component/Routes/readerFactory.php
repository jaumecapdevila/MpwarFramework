<?php 
namespace MpwarFramework\Component\Routes;
use MpwarFramework\Component\Routes\yamlFileReader;

class readerFactory 
{
    static function instantiateReader($type,$fileToRead) {
        switch ($type) {
            case 'yml':
                    return new yamlFileReader($fileToRead);
                break;
            case 'xml':
                    return new xmlFileReader($fileToRead);
                break;
            case 'php':
                    echo "PHP";
                break;
            default:
                    echo "Default case";
                break;
        }
    }
}