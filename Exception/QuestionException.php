<?php

/**
 *
 * @author:  Pichet PUTH <pichet.puth@utt.fr>
 * @license: GPL
 *
 */

namespace Tms\Bundle\FaqBundle\Exception;

class QuestionException extends \Exception
{
    /**
     * Constructor
     *
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct(sprintf(
            'Question exception: %s',
            $message
        ));
    }
}