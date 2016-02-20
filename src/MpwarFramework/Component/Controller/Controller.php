<?php

namespace MpwarFramework\Component\Controller;

use MpwarFramework\Component\Response\responseFactory;
use MpwarFramework\Component\Routes\Request;

abstract class Controller
{
    public function getHTMLResponse()
    {
        responseFactory::generateResponse("html");
    }
    public function getJSONResponse()
    {
        responseFactory::generateResponse("html");
    }
}
