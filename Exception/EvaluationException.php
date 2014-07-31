<?php

/**
 *
 * @author:  Pichet PUTH <pichet.puth@utt.fr>
 * @license: GPL
 *
 */

namespace Tms\Bundle\FaqBundle\Exception;

class EvaluationException extends \Exception
{
    /**
     * Constructor
     *
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct(sprintf(
            'Evaluation exception: %s',
            $message
        ));
    }
}