<?php

/**
 *
 * @author:  Pichet PUTH <pichet.puth@utt.fr>
 * @license: GPL
 *
 */

namespace Tms\Bundle\FaqBundle\Event\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tms\Bundle\FaqBundle\Event\EvaluationEvents;
use Tms\Bundle\FaqBundle\Event\EvaluationEvent;
use Tms\Bundle\FaqBundle\Manager\QuestionManager;


class EvaluationSubscriber implements EventSubscriberInterface
{
    protected $questionManager;

    /**
     * Constructor
     *
     * @param Producer $notificationProcessingProducer
     */
    public function __construct(QuestionManager $questionManager)
    {
        $this->questionManager = $questionManager;
    }

    /**
     * Get Question manager
     *
     * @return QuestionManager
     */
    public function getQuestionManager()
    {
        return $this->questionManager;
    }

    /**
     * GetSubscribedEvents
     *
     * @return array
     */
    static public function getSubscribedEvents()
    {
        return array(
            EvaluationEvents::POST_CREATE => 'computeQuestionAverage',
            EvaluationEvents::POST_UPDATE => 'computeQuestionAverage'
        );
    }

    /**
     * Compute Question average
     *
     * @param EvaluationEvent $event
     */
    public function computeQuestionAverage(EvaluationEvent $event)
    {
        $question = $event->getEvaluation()->getQuestion();
        $question->updateAverage();

        $this->getQuestionManager()->update($question);
    }
}