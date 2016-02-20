<?php
namespace MpwarFramework\Component\Response;

class htmlResponse
{
    const HTTP_OK = 200;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;

    public $headers = array();
    protected $content;
    protected $statusCode;
    protected $statusText;

    public function __construct($content = '', $status = 200, $headers = array())
    {
        $this->headers = $headers;
        $this->setContent($content);
        $this->setStatusCode($status);
    }

    public function sendContent()
    {
        echo $this->content;
        return $this;
    }

    public function setContent($content)
    {
        $this->content = (string) $content;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setStatusCode($code, $text = null)
    {
        $this->statusCode = $code = (int) $code;
        $this->statusText = $text;

        return $this;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }


}

