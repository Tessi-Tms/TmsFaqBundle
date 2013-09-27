<?php

namespace Tms\Bundle\FaqBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class QuestionEvent extends Event
{
    protected $question;

    public function __construct($question)
    {
        $this->question = $question;
    }

    public function getQuestion()
    {
        return $this->question;
    }
}
