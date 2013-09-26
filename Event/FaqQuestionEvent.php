<?php

namespace Tms\Bundle\FaqBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class FaqQuestionEvent extends Event
{
    protected $faqQuestion;

    public function __construct($faqQuestion)
    {
        $this->faqQuestion = $faqQuestion;
    }

    public function getFaqQuestion()
    {
        return $this->faqQuestion;
    }
}
