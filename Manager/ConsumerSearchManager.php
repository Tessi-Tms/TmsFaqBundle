<?php

namespace Tms\Bundle\FaqBundle\Manager;

use Tms\Bundle\FaqBundle\Entity\ConsumerSearch;
use Tms\Bundle\FaqBundle\Event\ConsumerSearchEvent;
use Tms\Bundle\FaqBundle\Event\ConsumerSearchEvents;

/**
 * ConsumerSearch manager.
 *
 * @author Danielle HODIEB <danielle.hodieb@tessi.fr>
 */
class ConsumerSearchManager extends AbstractManager
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return "TmsFaqBundle:ConsumerSearch";
    }

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $this->getEventDispatcher()->dispatch(
            ConsumerSearchEvents::PRE_CREATE,
            new ConsumerSearchEvent($entity)
        );

        parent::add($entity);

        $this->getEventDispatcher()->dispatch(
           ConsumerSearchEvents::POST_CREATE,
            new ConsumerSearchEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $this->getEventDispatcher()->dispatch(
            ConsumerSearchEvents::PRE_UPDATE,
            new ConsumerSearchEvent($entity)
        );

        parent::update($entity);

        $this->getEventDispatcher()->dispatch(
            ConsumerSearchEvents::POST_UPDATE,
            new ConsumerSearchEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $this->getEventDispatcher()->dispatch(
            ConsumerSearchEvents::PRE_DELETE,
            new ConsumerSearchEvent($entity)
        );

        parent::delete($entity);

        $this->getEventDispatcher()->dispatch(
            ConsumerSearchnEvents::POST_DELETE,
            new ConsumerSearchEvent($entity)
        );
    }
}
