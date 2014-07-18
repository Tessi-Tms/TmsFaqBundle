<?php

namespace Tms\Bundle\FaqBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Tms\Bundle\FaqBundle\Entity\Faq;

class FaqEvent extends Event
{
    protected $faq;

    /**
     * Constructor
     *
     * @param Faq $faq
     */
    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    /**
     * Get faq
     *
     * @return Faq
     */
    public function getFaq()
    {
        return $this->faq;
    }
}
