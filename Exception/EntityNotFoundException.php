<?php

/**
 *
 * @author Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */
namespace Tms\Bundle\FaqBundle\Exception;

class EntityNotFoundException extends \Exception
{
    /**
     * The constructor.
     */
    public function __construct()
    {
        parent::__construct('Entity not found.');
    }
}
