<?php

namespace Tms\Bundle\FaqBundle\Manager;

use Tms\Bundle\FaqBundle\Entity\Response;
use Tms\Bundle\FaqBundle\Event\ResponseEvent;
use Tms\Bundle\FaqBundle\Event\ResponseEvents;
use Tms\Bundle\FaqBundle\Indexer\ResponseIndexer;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;

/**
 * Response manager.
 *
 * @author Danielle HODIEB <danielle.hodieb@tessi.fr>
 */
class ResponseManager extends AbstractManager
{
    protected $indexer;

    public function __construct(EntityManager $entityManager, ContainerAwareEventDispatcher $eventDispatcher, ResponseIndexer $responseIndexer)
    {
        parent::__construct($entityManager, $eventDispatcher);
        $this->indexer = $responseIndexer;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return "TmsFaqBundle:Response";
    }

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $this->getEventDispatcher()->dispatch(
            ResponseEvents::PRE_CREATE,
            new ResponseEvent($entity)
        );

        parent::add($entity);

        $this->getEventDispatcher()->dispatch(
           ResponseEvents::POST_CREATE,
            new ResponseEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $this->getEventDispatcher()->dispatch(
            ResponseEvents::PRE_UPDATE,
            new ResponseEvent($entity)
        );

        parent::update($entity);

        $this->getEventDispatcher()->dispatch(
            ResponseEvents::POST_UPDATE,
            new ResponseEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $this->getEventDispatcher()->dispatch(
            ResponseEvents::PRE_DELETE,
            new ResponseEvent($entity)
        );

        parent::delete($entity);

        $this->getEventDispatcher()->dispatch(
            ResponseEvents::POST_DELETE,
            new ResponseEvent($entity)
        );
    }

    /**
     * Compute average for a given Response
     * @param Response $response
     * @return float
     */
    public function computeAverage($entity)
    {
        $evaluations = $entity->getEvaluations();
        $average = 0;
        $numberOfEvaluation = count($evaluations);
        if($numberOfEvaluation != 0){
            foreach($evaluations->toArray() as $evaluation){
                $average = $average + $evaluation->getValue();
            }
            $average = $average/$numberOfEvaluation;
            //$average = array_sum($evaluations->toArray())/$numberOfEvaluation;
        }
        $entity->setAverage($average);
        $this->update($entity);
    }

     /**
     * Search entity via indexer
     *
     * @param string $query
     *
     * @return array Responses
     */
    public function search($query)
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

        return $this->findAllIn($ids);
    }
}
