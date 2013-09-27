<?php

namespace Tms\Bundle\FaqBundle\Event;

final class QuestionEvents
{
    /**
     * @var string
     */
    const PRE_CREATE =  'tms_faq.question.pre_create';
    const POST_CREATE = 'tms_faq.question.post_create';

    const PRE_UPDATE =  'tms_faq.question.pre_update';
    const POST_UPDATE = 'tms_faq.question.post_update';

    const PRE_DELETE =  'tms_faq.question.pre_delete';
    const POST_DELETE = 'tms_faq.question.post_delete';
}
