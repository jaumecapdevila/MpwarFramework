<?php

namespace MpwarFramework\Component\Templating;
define('SMARTY_DIR', '..//vendor/smarty/libs/');
require_once(SMARTY_DIR . 'Smarty.class.php');


class FileLoader
{
    private $fileToRender;

    public function __construct($fileToRender)
    {
        $this->fileToRender = $fileToRender;

    }

    public function renderWithAdequateTemplate()
    {
        $fileInformation = $this->getFileInformation($this->fileToRender);
        if ($fileInformation["extension"] == "twig") {
            $loader = new \Twig_Loader_Filesystem($fileInformation["path"]);
            $twig = new \Twig_Environment($loader, ['debug' => true]);
            echo $twig->render($fileInformation["name"]);
        } else {

        }
    }

    private function getFileInformation($file)
    {
        $separatedPath = explode("/", $file);
        $totalElements = count($separatedPath);
        $fileName = $separatedPath[$totalElements - 1];
        $fileExtension = explode(".", $separatedPath[$totalElements - 1])[1];
        $filePath = "";
        for ($i = 0; $i < $totalElements - 1; $i++) {
            $filePath .= $separatedPath[$i] . "/";
        }
        $fileInfo = [
            "name" => $fileName,
            "extension" => $fileExtension,
            "path" => "../src" . $filePath
        ];
        return $fileInfo;
    }
}