<?php

namespace Tms\Bundle\FaqBundle\Manager;

use Tms\Bundle\FaqBundle\Entity\FaqQuestionCategory;
use Tms\Bundle\FaqBundle\Event\FaqQuestionCategoryEvent;
use Tms\Bundle\FaqBundle\Event\FaqQuestionCategoryEvents;

/**
 * QuestionCategory manager.
 *
 * @author Danielle HODIEB <danielle.hodieb@tessi.fr>
 */
class FaqQuestionCategoryManager extends AbstractManager
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return "TmsFaqBundle:FaqQuestionCategory";
    }

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqQuestionCategoryEvents::PRE_CREATE,
            new FaqQuestionCategoryEvent($entity)
        );

        parent::add($entity);

        $this->getEventDispatcher()->dispatch(
           FaqQuestionCategoryEvents::POST_CREATE,
            new FaqQuestionCategoryEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqQuestionCategoryEvents::PRE_UPDATE,
            new FaqQuestionCategoryEvent($entity)
        );

        parent::update($entity);

        $this->getEventDispatcher()->dispatch(
            FaqQuestionCategoryEvents::POST_UPDATE,
            new FaqQuestionCategoryEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqQuestionCategoryEvents::PRE_DELETE,
            new FaqQuestionCategoryEvent($entity)
        );

        parent::delete($entity);

        $this->getEventDispatcher()->dispatch(
            FaqQuestionCategoryEvents::POST_DELETE,
            new FaqQuestionCategoryEvent($entity)
        );
    }
}
