<?php


namespace MpwarFramework\Component\Routes;
use MpwarFramework\Component\Request\Request;

class Dispatcher
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function handle(Request $request)
    {
        return $this->router->matchRoute($request);
    }
}

