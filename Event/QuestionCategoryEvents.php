<?php

namespace Tms\Bundle\FaqBundle\Event;

final class QuestionCategoryEvents
{
    /**
     * @var string
     */
    const PRE_CREATE =  'tms_faq.question_category.pre_create';
    const POST_CREATE = 'tms_faq.question_category.post_create';

    const PRE_UPDATE =  'tms_faq.question_category.pre_update';
    const POST_UPDATE = 'tms_faq.question_category.post_update';

    const PRE_DELETE =  'tms_faq.question_category.pre_delete';
    const POST_DELETE = 'tms_faq.question_category.post_delete';
}
