<?php

/**
 * @author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Manager;

use Tms\Bundle\FaqBundle\Entity\Evaluation;
use Tms\Bundle\FaqBundle\Event\EvaluationEvent;
use Tms\Bundle\FaqBundle\Event\EvaluationEvents;
use Tms\Bundle\FaqBundle\Exception\EvaluationException;

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

    /**
     * Decode data
     *
     * @param string $data in json format
     */
    public function decodeData($data)
    {
        $evaluationsData = json_decode($data, true);
        if (!$evaluationsData) {
            throw new EvaluationException(sprintf(
                'Parse error : %s',
                $data
            ));
        }

        return $evaluationsData;
    }
}
