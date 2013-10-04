<?php

namespace Tms\Bundle\FaqBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class EvaluationEvent extends Event
{
    protected $evaluation;

    public function __construct($evaluation)
    {
        $this->evaluation = $evaluation;
    }

    public function getEvaluation()
    {
        return $this->evaluation;
    }
}
