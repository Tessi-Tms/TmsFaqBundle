<?php

namespace Tms\Bundle\FaqBundle\Manager;

use Tms\Bundle\FaqBundle\Entity\FaqResponse;
use Tms\Bundle\FaqBundle\Event\FaqResponseEvent;
use Tms\Bundle\FaqBundle\Event\FaqResponseEvents;

/**
 * Response manager.
 *
 * @author Danielle HODIEB <danielle.hodieb@tessi.fr>
 */
class FaqResponseManager extends AbstractManager
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return "TmsFaqBundle:FaqResponse";
    }

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqResponseEvents::PRE_CREATE,
            new FaqResponseEvent($entity)
        );

        parent::add($entity);

        $this->getEventDispatcher()->dispatch(
           FaqResponseEvents::POST_CREATE,
            new FaqResponseEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqResponseEvents::PRE_UPDATE,
            new FaqResponseEvent($entity)
        );

        parent::update($entity);

        $this->getEventDispatcher()->dispatch(
            FaqResponseEvents::POST_UPDATE,
            new FaqResponseEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqResponseEvents::PRE_DELETE,
            new FaqResponseEvent($entity)
        );

        parent::delete($entity);

        $this->getEventDispatcher()->dispatch(
            FaqResponsenEvents::POST_DELETE,
            new FaqResponseEvent($entity)
        );
    }
}
