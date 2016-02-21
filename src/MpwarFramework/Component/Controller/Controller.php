<?php

namespace MpwarFramework\Component\Controller;

use MpwarFramework\Component\Response\responseFactory;
use MpwarFramework\Component\Routes\Request;
use MpwarFramework\Component\Templating\FileLoader;

abstract class Controller
{
    public function renderFile($fileToRender) {
        $fileLoader = new FileLoader($fileToRender);
        $fileLoader->renderWithAdequateTemplate();
    }
}
