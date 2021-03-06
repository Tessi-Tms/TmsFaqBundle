<?php

/**
 * @author Danielle HODIEB <danielle.hodieb@tessi.fr>
 * @author Pichet PUTH <pichet.puth@utt.fr>
 *
 *
 */

namespace Tms\Bundle\FaqBundle\Manager;

use Tms\Bundle\FaqBundle\Entity\Question;
use Tms\Bundle\FaqBundle\Event\QuestionEvent;
use Tms\Bundle\FaqBundle\Event\QuestionEvents;

class QuestionManager extends AbstractManager
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return "TmsFaqBundle:Question";
    }

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $this->getEventDispatcher()->dispatch(
            QuestionEvents::PRE_CREATE,
            new QuestionEvent($entity)
        );

        parent::add($entity);

        $this->getEventDispatcher()->dispatch(
            QuestionEvents::POST_CREATE,
            new QuestionEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $this->getEventDispatcher()->dispatch(
            QuestionEvents::PRE_UPDATE,
            new QuestionEvent($entity)
        );

        parent::update($entity);

        $this->getEventDispatcher()->dispatch(
            QuestionEvents::POST_UPDATE,
            new QuestionEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $this->getEventDispatcher()->dispatch(
            QuestionEvents::PRE_DELETE,
            new QuestionEvent($entity)
        );

        parent::delete($entity);

        $this->getEventDispatcher()->dispatch(
            QuestionEvents::POST_DELETE,
            new QuestionEvent($entity)
        );
    }
}
