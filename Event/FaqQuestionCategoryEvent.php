<?php

namespace Tms\Bundle\FaqBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class FaqQuestionCategoryEvent extends Event
{
    protected $faqQuestionCategory;

    public function __construct($faqQuestionCategory)
    {
        $this->faqQuestionCategory = $faqQuestionCategory;
    }

    public function getFaqQuestionCategory()
    {
        return $this->faqQuestionCategory;
    }
}
