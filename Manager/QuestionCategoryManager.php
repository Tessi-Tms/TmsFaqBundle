<?php

/**
 * @author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Manager;

use Tms\Bundle\FaqBundle\Entity\QuestionCategory;
use Tms\Bundle\FaqBundle\Event\QuestionCategoryEvent;
use Tms\Bundle\FaqBundle\Event\QuestionCategoryEvents;

class QuestionCategoryManager extends AbstractManager
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return "TmsFaqBundle:QuestionCategory";
    }

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $this->getEventDispatcher()->dispatch(
            QuestionCategoryEvents::PRE_CREATE,
            new QuestionCategoryEvent($entity)
        );

        parent::add($entity);

        $this->getEventDispatcher()->dispatch(
           QuestionCategoryEvents::POST_CREATE,
            new QuestionCategoryEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $this->getEventDispatcher()->dispatch(
            QuestionCategoryEvents::PRE_UPDATE,
            new QuestionCategoryEvent($entity)
        );

        parent::update($entity);

        $this->getEventDispatcher()->dispatch(
            QuestionCategoryEvents::POST_UPDATE,
            new QuestionCategoryEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $this->getEventDispatcher()->dispatch(
            QuestionCategoryEvents::PRE_DELETE,
            new QuestionCategoryEvent($entity)
        );

        parent::delete($entity);

        $this->getEventDispatcher()->dispatch(
            QuestionCategoryEvents::POST_DELETE,
            new QuestionCategoryEvent($entity)
        );
    }
}
