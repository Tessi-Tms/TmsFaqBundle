<?php

namespace Tms\Bundle\FaqBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class FaqEvent extends Event
{
    protected $faq;

    public function __construct($faq)
    {
        $this->faq = $faq;
    }

    public function getFaq()
    {
        return $this->faq;
    }
}
