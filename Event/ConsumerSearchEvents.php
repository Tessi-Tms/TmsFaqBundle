<?php

namespace Tms\Bundle\FaqBundle\Event;

final class ConsumerSearchEvents
{
    /**
     * @var string
     */
    const PRE_CREATE =  'tms_consumer_search.consumer_search.pre_create';
    const POST_CREATE = 'tms_consumer_search.consumer_search.post_create';

    const PRE_UPDATE =  'tms_consumer_search.consumer_searchn.pre_update';
    const POST_UPDATE = 'tms_consumer_searchn.consumer_searchn.post_update';

    const PRE_DELETE =  'tms_consumer_search.consumer_search.pre_delete';
    const POST_DELETE = 'tms_consumer_search.consumer_search.post_delete';
}
