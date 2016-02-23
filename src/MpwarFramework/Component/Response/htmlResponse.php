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
    protected $contentType;

    public function __construct($content = '', $status = 200, $type = "text/html", $headers = array())
    {
        $this->headers = $headers;
        $this->contentType = $type;
        $this->setContent($content);
        $this->setStatusCode($status);
    }

    public function Send()
    {
        $this->sendHeaders();
        $this->sendContent();

    }

    private function sendContent()
    {
        echo $this->content;
        return $this;
    }

    private function sendHeaders()
    {
        http_response_code($this->headers["statusCode"]);
        header('Content-Type:'.$this->contentType);
    }

    public function setContent($content)
    {
        $this->content = (string)$content;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setStatusCode($code, $text = null)
    {
        $this->statusCode = $code = (int)$code;
        $this->statusText = $text;
        $this->headers["statusCode"] = $code;
        return $this;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }


}

