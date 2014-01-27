<?php

namespace Tms\Bundle\FaqBundle\Manager;

use Doctrine\ORM\EntityManager;
use Tms\Bundle\FaqBundle\Manager\FaqManager;
use Tms\Bundle\FaqBundle\Manager\QuestionManager;
use Tms\Bundle\FaqBundle\Manager\QuestionCategoryManager;
use Tms\Bundle\FaqBundle\Manager\ResponseManager;
use Tms\Bundle\FaqBundle\Manager\EvaluationManager;
use Tms\Bundle\FaqBundle\Manager\ConsumerSearchManager;
use Tms\Bundle\FaqBundle\Indexer\FaqIndexer;
use Tms\Bundle\FaqBundle\Exception\EntityNotFoundException;
use Tms\Bundle\FaqBundle\Entity\Evaluation;
use Tms\Bundle\FaqBundle\Entity\ConsumerSearch;
use Tms\Bundle\FaqBundle\Entity\Faq;
use Tms\Bundle\FaqBundle\Entity\Question;
use Tms\Bundle\FaqBundle\Tools\StringTools;
use Tms\Bundle\SearchBundle\handler\SearchIndexHandler;

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
    protected $consumerSearchManager;
    protected $searchIndexHandler;

    public function __construct(FaqManager $faqManager,
                                QuestionManager $questionManager,
                                QuestionCategoryManager $questionCategoryManager,
                                ResponseManager $responseManager,
                                EvaluationManager $evaluationManager,
                                ConsumerSearchManager $consumerSearchManager,
                                SearchIndexHandler $searchIndexHandler)
    {
        $this->faqManager = $faqManager;
        $this->questionManager = $questionManager;
        $this->questionCategoryManager = $questionCategoryManager;
        $this->responseManager = $responseManager;
        $this->evaluationManager = $evaluationManager;
        $this->consumerSearchManager = $consumerSearchManager;
        $this->searchIndexHandler = $searchIndexHandler;
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
        return $this->questionCategoryManager;
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
     * Get ConsumerSearchManager
     *
     * @return ConsumerSearchManager
     */
    public function getConsumerSearchManager()
    {
        return $this->consumerSearchManager;
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
        // set UserId
        $this->getEvaluationManager()->add($entity);
        $this->getResponseManager()->computeAverage($response);

        return $entity;
    }

    /**
     * Create a consumerSearch for a given response, answerFound and query
     *
     * @param string $responseId
     * @param string $answerFound
     * @param string $query
     * @param string $userId
     * @return ConsumerSearch
     */
    public function addConsumerSearch($response_id, $answerFound, $query, $userId = null)
    {
        $entity = new ConsumerSearch();
        $response = $this->getResponseManager()->find($response_id);
        if(!$response){
            throw new EntityNotFoundException();
        }
        $entity->setResponse($response);
        $entity->setAnswerFound((bool)$answerFound);
        $entity->setQuery($query);
        // set UserId
        $this->getConsumerSearchManager()->add($entity);

        return $entity;
    }

    /**
     *
     * @param integer $customerId
     * @param string $searchQuery
     * @throws EntityNotFoundException
     */
    public function search($customerId, $searchQuery)
    {
        $faq = $this->getFaqManager()->findOneByCustomerId(array("customerId" => $customerId));
        if (!$faq) {
            throw new EntityNotFoundException();
        }

        $data = $this->searchIndexHandler->searchAndFetchEntity('tms_faq_question', $searchQuery);
        $questions = array();
        if (isset($data['data'])) {
            $questions = $data['data'];
        }

        $ids = array();
        foreach ($questions as $question) {
            $ids[] = $question->getId();
        }

        foreach ($faq->getQuestions() as $question) {
            if (!in_array($question->getId(), $ids)) {
                $faq->removeQuestion($question);
            }
        }

        return $faq;
    }
}
