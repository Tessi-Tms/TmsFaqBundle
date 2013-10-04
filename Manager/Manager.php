<?php

namespace Tms\Bundle\FaqBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;
use Tms\Bundle\FaqBundle\Manager\FaqManager;
use Tms\Bundle\FaqBundle\Manager\QuestionManager;
use Tms\Bundle\FaqBundle\Manager\QuestionCategoryManager;
use Tms\Bundle\FaqBundle\Manager\ResponseManager;
use Tms\Bundle\FaqBundle\Manager\EvaluationManager;
use Tms\Bundle\FaqBundle\Exception\EntityNotFoundException;
use Tms\Bundle\FaqBundle\Entity\Evaluation;

/**
 * Manager.
 *
 * @author Danielle HODIEB <danielle.hodieb@tessi.fr>
 */
class Manager
{
    protected $faqManager;
    protected $questionManager;
    protected $questionCategoryManager;
    protected $responseManager;
    protected $evaluationManager;
    protected $eventDispatcher;

    public function __construct(FaqManager $faqManager,
                                QuestionManager $questionManager,
                                QuestionCategoryManager $questionCategoryManager,
                                ResponseManager $responseManager,
                                EvaluationManager $evaluationManager,
                                ContainerAwareEventDispatcher $eventDispatcher)
    {
        $this->faqManager = $faqManager;
        $this->questionManager = $questionManager;
        $this->questionCategoryManager = $questionCategoryManager;
        $this->responseManager = $responseManager;
        $this->evaluationManager = $evaluationManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Get FaqManager
     *
     * @return FaqManager
     */
    public function getFaqManager()
    {
        return $this->faqManager;
    }

    /**
     * Get QuestionManager
     *
     * @return QuestionManager
     */
    public function getQuestionManager()
    {
        return $this->questionManager;
    }

    /**
     * Get QuestionCategoryManager
     *
     * @return QuestionCategoryManager
     */
    public function getQuestionCategoryManager()
    {
        return $this->questionCategoryqManager;
    }

    /**
     * Get ResponseManager
     *
     * @return ResponseManager
     */
    public function getResponseManager()
    {
        return $this->responseManager;
    }

    /**
     * Get EvaluationManager
     *
     * @return EvaluationManager
     */
    public function getEvaluationManager()
    {
        return $this->evaluationManager;
    }

    /**
     * Get EventDispatcher
     *
     * @return ContainerAwareEventDispatcher
     */
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }

    /**
     * Create an evaluation for a given response
     *
     * @param string $responseId
     * @param string $value
     * @param string $userId
     * @return Evaluation
     */
    public function addEvaluation($response_id, $value, $userId = null)
    {
        $entity = new Evaluation();
        $response = $this->getResponseManager()->find($response_id);
        if(!$response){
            throw new EntityNotFoundException();
        }
        $entity->setResponse($response);
        $entity->setValue($value);
        $this->getEvaluationManager()->add($entity);

        return $entity;
    }
}
