<?php

namespace Tms\Bundle\FaqBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class ResponseEvent extends Event
{
    protected $response;

    public function __construct($responsen)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
