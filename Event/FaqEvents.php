<?php

namespace Tms\Bundle\FaqBundle\Event;

final class FaqEvents
{
    /**
     * @var string
     */
    const PRE_CREATE =  'tms_faq.faq.pre_create';
    const POST_CREATE = 'tms_faq.faq.post_create';

    const PRE_UPDATE =  'tms_faq.faq.pre_update';
    const POST_UPDATE = 'tms_faq.faq.post_update';

    const PRE_DELETE =  'tms_faq.faq.pre_delete';
    const POST_DELETE = 'tms_faq.faq.post_delete';
}
