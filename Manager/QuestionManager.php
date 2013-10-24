<?php
namespace Tms\Bundle\FaqBundle\Manager;

use Tms\Bundle\FaqBundle\Entity\Question;
use Tms\Bundle\FaqBundle\Event\QuestionEvent;
use Tms\Bundle\FaqBundle\Event\QuestionEvents;
use Tms\Bundle\FaqBundle\Indexer\QuestionIndexer;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;

/**
 * Question manager.
 *
 * @author Danielle HODIEB <danielle.hodieb@tessi.fr>
 */
class QuestionManager extends AbstractManager
{
    protected $indexer;

    public function __construct(EntityManager $entityManager, ContainerAwareEventDispatcher $eventDispatcher, QuestionIndexer $questionIndexer)
    {
        parent::__construct($entityManager, $eventDispatcher);
        $this->indexer = $questionIndexer;
    }

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

    /**
     * Search entity via indexer
     *
     * @param string $query
     *
     * @return array Questions
     */
    public function search($query, $faq)
    {
        if(is_null($query)) {
            return $this->findAll();
        }

        $hits = $this->indexer->search($query);

        if(!$hits) {
            return array();
        }

        $ids = array();
        foreach ($hits as $hit) {
            $ids[] = $hit->key;
        }

        return $this->findAllIn($ids, $faq);
    }

}
