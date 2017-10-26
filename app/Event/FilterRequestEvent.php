<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FilterRequestEvent extends event
{
    private $request;

    private $response;

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
    public function getRequest()
    {
        return $this->request;
    }
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }
    public function getResponse()
    {
        return $this->response;
    }
}
