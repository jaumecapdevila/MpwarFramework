<?php

namespace MpwarFramework\Component\Response;
use MpwarFramework\Component\Response\htmlResponse;
use MpwarFramework\Component\Response\jsonResponse;

class responseFactory
{
    public static function generateResponse($type) {
        switch ($type) {
            case "html":
                    return new htmlResponse();
                break;
            case "json":
                    return new jsonResponse();
                break;
        }
    }
}

