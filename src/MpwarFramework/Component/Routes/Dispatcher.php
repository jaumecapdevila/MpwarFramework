<?php


namespace MpwarFramework\Component\Routes;

class Dispatcher
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function handle(Request $request)
    {
        $this->router->matchRoute($request);
    }
}

