<?php

namespace Tms\Bundle\FaqBundle\Event\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tms\Bundle\FaqBundle\Event\QuestionEvents;
use Tms\Bundle\FaqBundle\Event\QuestionEvent;
use Tms\Bundle\FaqBundle\Indexer\FaqIndexer;

class QuestionIndexerSubscriber implements EventSubscriberInterface
{
    protected $indexer;

    /**
     * Constructor
     *
     * @param $notifier
     */
    public function __construct(FaqIndexer $indexer)
    {
        $this->indexer = $indexer;
    }

    /**
     * @return Indexer
     */
    protected function getIndexer()
    {
        return $this->indexer;
    }

    /**
     * {@inheritdoc}
     */
    static public function getSubscribedEvents()
    {
        return array(
            QuestionEvents::POST_CREATE => array('onCreateQuestionPost', 0),
            QuestionEvents::POST_UPDATE => array('onUpdateQuestionPost', 0),
            QuestionEvents::PRE_DELETE => array('onDeleteQuestionPre', 0),
        );
    }

    public function onCreateQuestionPost(QuestionEvent $event)
    {
        $this->getIndexer()->add($event->getQuestion());
    }

    public function onUpdateQuestionPost(QuestionEvent $event)
    {
        $this->getIndexer()->update($event->getQuestion());
    }

    public function onDeleteQuestionPre(QuestionEvent $event)
    {
        $this->getIndexer()->delete($event->getQuestion());
    }
}
