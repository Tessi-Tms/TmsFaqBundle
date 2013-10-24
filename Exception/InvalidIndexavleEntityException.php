<?php

/**
 * 
 * @author:  Danielle HODIEB <danielle.hodieb@tessi.fr>
 * @license: MIT
 *
 */
 
namespace Tms\Bundle\FaqBundle\Exception;

class InvalidIndexableEntityException extends \Exception
{
    /**
     * The constructor.
     */
    public function __construct($entity)
    {
        $reflection = new \ReflectionClass($entity);
    
        parent::__construct(sprintf(
            'Wrong entity given: %s.', 
            $reflection->getName()
        ));
    }
}
