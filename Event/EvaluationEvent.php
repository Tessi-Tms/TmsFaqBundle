<?php

namespace Tms\Bundle\FaqBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Tms\Bundle\FaqBundle\Entity\Evaluation;

class EvaluationEvent extends Event
{
    protected $evaluation;

    /**
     * Constructor
     *
     * @param Evaluation $evaluation
     */
    public function __construct(Evaluation $evaluation)
    {
        $this->evaluation = $evaluation;
    }

    /**
     * Get Evaluation
     *
     * @return Evaluation
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }
}
