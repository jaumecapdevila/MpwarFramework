<?php

namespace MpwarFramework\Component\Controller;

use MpwarFramework\Component\Response\responseFactory;
use MpwarFramework\Component\Templating\FileLoader;

abstract class Controller
{
    public function renderFile($fileToRender,$params) {
        $fileLoader = new FileLoader($fileToRender);
       return $fileLoader->renderWithAdequateTemplate($params);
    }
}
