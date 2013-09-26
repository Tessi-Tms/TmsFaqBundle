<?php

namespace Tms\Bundle\FaqBundle\Manager;

use Tms\Bundle\FaqBundle\Entity\Response;
use Tms\Bundle\FaqBundle\Event\ResponseEvent;
use Tms\Bundle\FaqBundle\Event\ResponseEvents;

/**
 * Response manager.
 *
 * @author Danielle HODIEB <danielle.hodieb@tessi.fr>
 */
class ResponseManager extends AbstractManager
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return "TmsFaqBundle:Response";
    }

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $this->getEventDispatcher()->dispatch(
            ResponseEvents::PRE_CREATE,
            new ResponseEvent($entity)
        );

        parent::add($entity);

        $this->getEventDispatcher()->dispatch(
           ResponseEvents::POST_CREATE,
            new ResponseEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $this->getEventDispatcher()->dispatch(
            ResponseEvents::PRE_UPDATE,
            new ResponseEvent($entity)
        );

        parent::update($entity);

        $this->getEventDispatcher()->dispatch(
            ResponseEvents::POST_UPDATE,
            new ResponseEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $this->getEventDispatcher()->dispatch(
            ResponseEvents::PRE_DELETE,
            new ResponseEvent($entity)
        );

        parent::delete($entity);

        $this->getEventDispatcher()->dispatch(
            ResponsenEvents::POST_DELETE,
            new ResponseEvent($entity)
        );
    }
}
