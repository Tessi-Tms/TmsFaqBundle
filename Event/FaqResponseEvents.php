<?php

namespace Tms\Bundle\FaqBundle\Event;

final class FaqResponseEvents
{
    /**
     * @var string
     */
    const PRE_CREATE =  'tms_faq.faq_response.pre_create';
    const POST_CREATE = 'tms_faq.faq_response.post_create';

    const PRE_UPDATE =  'tms_faq.faq_responsen.pre_update';
    const POST_UPDATE = 'tms_faq.faq_response.post_update';

    const PRE_DELETE =  'tms_faq.faq_response.pre_delete';
    const POST_DELETE = 'tms_faq.faq_response.post_delete';
}
