<?php

namespace Tms\Bundle\FaqBundle\Event;

final class ResponseEvents
{
    /**
     * @var string
     */
    const PRE_CREATE =  'tms_faq.response.pre_create';
    const POST_CREATE = 'tms_faq.response.post_create';

    const PRE_UPDATE =  'tms_faq.responsen.pre_update';
    const POST_UPDATE = 'tms_faq.response.post_update';

    const PRE_DELETE =  'tms_faq.response.pre_delete';
    const POST_DELETE = 'tms_faq.response.post_delete';
}
