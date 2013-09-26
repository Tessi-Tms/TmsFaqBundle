<?php

namespace Tms\Bundle\FaqBundle\Event;

final class FaqQuestionEvents
{
    /**
     * @var string
     */
    const PRE_CREATE =  'tms_faq.faq_question.pre_create';
    const POST_CREATE = 'tms_faq.faq_question.post_create';

    const PRE_UPDATE =  'tms_faq.faq_question.pre_update';
    const POST_UPDATE = 'tms_faq.faq_question.post_update';

    const PRE_DELETE =  'tms_faq.faq_question.pre_delete';
    const POST_DELETE = 'tms_faq.faq_question.post_delete';
}
