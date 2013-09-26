<?php

namespace Tms\Bundle\FaqBundle\Manager;

use Tms\Bundle\FaqBundle\Entity\FaqQuestion;
use Tms\Bundle\FaqBundle\Event\FaqQuestionEvent;
use Tms\Bundle\FaqBundle\Event\FaqQuestionEvents;

/**
 * Question manager.
 *
 * @author Danielle HODIEB <danielle.hodieb@tessi.fr>
 */
class FaqQuestionManager extends AbstractManager
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return "TmsFaqBundle:FaqQuestion";
    }

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqQuestionEvents::PRE_CREATE,
            new FaqQuestionEvent($entity)
        );

        parent::add($entity);

        $this->getEventDispatcher()->dispatch(
           FaqQuestionEvents::POST_CREATE,
            new FaqQuestionEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqQuestionEvents::PRE_UPDATE,
            new FaqQuestionEvent($entity)
        );

        parent::update($entity);

        $this->getEventDispatcher()->dispatch(
            FaqQuestionEvents::POST_UPDATE,
            new FaqQuestionEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqQuestionEvents::PRE_DELETE,
            new FaqQuestionEvent($entity)
        );

        parent::delete($entity);

        $this->getEventDispatcher()->dispatch(
            FaqQuestionEvents::POST_DELETE,
            new FaqQuestionEvent($entity)
        );
    }
}
