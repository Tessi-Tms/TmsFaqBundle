<?php

/**
 * @author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Manager;

use Tms\Bundle\FaqBundle\Entity\Faq;
use Tms\Bundle\FaqBundle\Event\FaqEvent;
use Tms\Bundle\FaqBundle\Event\FaqEvents;

class FaqManager extends AbstractManager
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return "TmsFaqBundle:Faq";
    }

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqEvents::PRE_CREATE,
            new FaqEvent($entity)
        );

        parent::add($entity);

        $this->getEventDispatcher()->dispatch(
            FaqEvents::POST_CREATE,
            new FaqEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqEvents::PRE_UPDATE,
            new FaqEvent($entity)
        );

        parent::update($entity);

        $this->getEventDispatcher()->dispatch(
            FaqEvents::POST_UPDATE,
            new FaqEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqEvents::PRE_DELETE,
            new FaqEvent($entity)
        );

        parent::delete($entity);

        $this->getEventDispatcher()->dispatch(
            FaqEvents::POST_DELETE,
            new FaqEvent($entity)
        );
    }
}
