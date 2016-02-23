<?php

namespace MpwarFramework\Component\Templating;

class FileLoader
{
    private $fileToRender;

    public function __construct($fileToRender)
    {
        $this->fileToRender = $fileToRender;

    }

    public function renderWithAdequateTemplate($params)
    {
        $fileInformation = $this->getFileInformation($this->fileToRender);
        if ($fileInformation["extension"] == "twig") {
            $loader = new \Twig_Loader_Filesystem($fileInformation["path"]);
            $twig = new \Twig_Environment($loader, ['debug' => true]);
            return $twig->render($fileInformation["name"], $params);
        } else {
            $smarty = new \Smarty();
            $smarty->setTemplateDir($fileInformation["path"]);
            $smarty->assign('Params', $params);
            return $smarty->fetch($fileInformation["name"]);
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
