<?php

namespace Tms\Bundle\FaqBundle\Event;

final class EvaluationEvents
{
    /**
     * @var string
     */
    const PRE_CREATE =  'tms_evaluation.evaluation.pre_create';
    const POST_CREATE = 'tms_evaluation.evaluation.post_create';

    const PRE_UPDATE =  'tms_evaluation.evaluation.pre_update';
    const POST_UPDATE = 'tms_evaluation.evaluation.post_update';

    const PRE_DELETE =  'tms_evaluation.evaluation.pre_delete';
    const POST_DELETE = 'tms_evaluation.evaluation.post_delete';
}
