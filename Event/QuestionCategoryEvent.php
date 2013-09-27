<?php

namespace Tms\Bundle\FaqBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class QuestionCategoryEvent extends Event
{
    protected $questionCategory;

    public function __construct($questionCategory)
    {
        $this->questionCategory = $questionCategory;
    }

    public function getQuestionCategory()
    {
        return $this->questionCategory;
    }
}
