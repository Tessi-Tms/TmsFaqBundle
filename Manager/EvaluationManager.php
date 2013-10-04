<?php

namespace Tms\Bundle\FaqBundle\Manager;

use Tms\Bundle\FaqBundle\Entity\Evaluation;
use Tms\Bundle\FaqBundle\Event\EvaluationEvent;
use Tms\Bundle\FaqBundle\Event\EvaluationEvents;

/**
 * Evaluation manager.
 *
 * @author Danielle HODIEB <danielle.hodieb@tessi.fr>
 */
class EvaluationManager extends AbstractManager
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return "TmsFaqBundle:Evaluation";
    }

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $this->getEventDispatcher()->dispatch(
            EvaluationEvents::PRE_CREATE,
            new EvaluationEvent($entity)
        );

        parent::add($entity);

        $this->getEventDispatcher()->dispatch(
           EvaluationEvents::POST_CREATE,
            new EvaluationEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $this->getEventDispatcher()->dispatch(
            EvaluationEvents::PRE_UPDATE,
            new EvaluationEvent($entity)
        );

        parent::update($entity);

        $this->getEventDispatcher()->dispatch(
            EvaluationEvents::POST_UPDATE,
            new EvaluationEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $this->getEventDispatcher()->dispatch(
            EvaluationEvents::PRE_DELETE,
            new EvaluationEvent($entity)
        );

        parent::delete($entity);

        $this->getEventDispatcher()->dispatch(
            EvaluationEvents::POST_DELETE,
            new EvaluationEvent($entity)
        );
    }
}
