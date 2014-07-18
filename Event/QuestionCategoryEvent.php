<?php

namespace Tms\Bundle\FaqBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Tms\Bundle\FaqBundle\Entity\QuestionCategory;

class QuestionCategoryEvent extends Event
{
    protected $questionCategory;

    /**
     * Constructor
     *
     * @param QuestionCategory $questionCategory
     */
    public function __construct(QuestionCategory $questionCategory)
    {
        $this->questionCategory = $questionCategory;
    }

    /**
     * Get question category
     *
     * @return QuestionCategory
     */
    public function getQuestionCategory()
    {
        return $this->questionCategory;
    }
}
