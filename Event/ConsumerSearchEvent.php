<?php

namespace Tms\Bundle\FaqBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class ConsumerSearchEvent extends Event
{
    protected $consumerSearch;

    public function __construct($consumerSearch)
    {
        $this->consumerSearch = $consumerSearch;
    }

    public function getConsumerSearch()
    {
        return $this->consumerSearch;
    }
}
