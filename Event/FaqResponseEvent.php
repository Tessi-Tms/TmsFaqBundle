<?php

namespace Tms\Bundle\FaqBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class FaqResponseEvent extends Event
{
    protected $faqResponse;

    public function __construct($faqResponse)
    {
        $this->faqResponse = $faqResponse;
    }

    public function getFaqResponse()
    {
        return $this->faqResponse;
    }
}
