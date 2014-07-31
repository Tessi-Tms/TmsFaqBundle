<?php

/**
 *
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Pichet PUTH <pichet.puth@utt.fr>
 * @license: GPL
 *
 */

namespace Tms\Bundle\FaqBundle\Controller\Rest;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Util\Codes;
use JMS\Serializer\SerializationContext;
use Tms\Bundle\RestBundle\Formatter\AbstractHypermediaFormatter;
use Tms\Bundle\FaqBundle\Entity\Evaluation;
use Tms\Bundle\FaqBundle\Exception\EvaluationException;
use Tms\Bundle\FaqBundle\Entity\Question;
use Tms\Bundle\FaqBundle\Exception\QuestionException;

/**
 * Evaluation API REST controller
 */
class ApiEvaluationController extends FOSRestController
{
    /**
     * [GET] /evaluations
     * Retrieve a set of Question
     *
     * @QueryParam(name="question_id", requirements="\d+", strict=true, nullable=true, description="(optional) Question id")
     * @QueryParam(name="limit", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination limit")
     * @QueryParam(name="offset", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination offset")
     * @QueryParam(name="page", requirements="\d+", strict=true, nullable=true, description="(optional) Page number")
     * @QueryParam(name="sort", array=true, nullable=true, description="(optional) Sort")
     *
     * @param integer $question_id
     * @param integer $limit
     * @param integer $offset
     * @param integer $page
     * @param array   $sort
     */
    public function getEvaluationsAction(
        $question_id = null,
        $limit       = null,
        $offset      = null,
        $page        = null,
        $sort        = null
    )
    {
        $view = $this->view(
            $this
                ->get('tms_rest.formatter.factory')
                ->create(
                    'orm_collection',
                    $this->getRequest()->get('_route'),
                    $this->getRequest()->getRequestFormat()
                )
                ->setObjectManager(
                    $this->get('doctrine.orm.entity_manager'),
                    $this
                        ->get('tms_faq.manager.evaluation')
                        ->getEntityClass()
                )
                ->setCriteria(array(
                    'question' => $question_id
                ))
                ->setSort($sort)
                ->setLimit($limit)
                ->setOffset($offset)
                ->setPage($page)
                ->format()
            ,
            Codes::HTTP_OK
        );

        $serializationContext = SerializationContext::create()
            ->setGroups(array(
                AbstractHypermediaFormatter::SERIALIZER_CONTEXT_GROUP_COLLECTION
            ))
        ;
        $view->setSerializationContext($serializationContext);

        return $this->handleView($view);
    }

    /**
     * [GET] /evaluations/{id}
     * Retrieve an Question
     *
     * @param integer $id
     */
    public function getEvaluationAction($id)
    {
        try {
            $view = $this->view(
            $this
                ->get('tms_rest.formatter.factory')
                ->create(
                    'item',
                    $this->getRequest()->get('_route'),
                    $this->getRequest()->getRequestFormat(),
                    $id
                )
                ->setObjectManager(
                    $this->get('doctrine.orm.entity_manager'),
                    $this
                        ->get('tms_faq.manager.evaluation')
                        ->getEntityClass()
                )
                ->addEmbedded(
                    'question',
                    'api_faq_evaluation_get_evaluation_question'
                )
                ->format(),
                Codes::HTTP_OK
            );

            $serializationContext = SerializationContext::create()
                ->setGroups(array(
                    AbstractHypermediaFormatter::SERIALIZER_CONTEXT_GROUP_ITEM
                ))
            ;
            $view->setSerializationContext($serializationContext);

            return $this->handleView($view);

        } catch(NotFoundHttpException $e) {
            return $this->handleView($this->view(
                array(),
                $e->getStatusCode()
            ));
        }
    }

    /**
     * [GET] /evaluations/{id}/question
     * Retrieve question associated with question
     *
     * @QueryParam(name="limit", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination limit")
     * @QueryParam(name="offset", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination offset")
     * @QueryParam(name="page", requirements="\d+", strict=true, nullable=true, description="(optional) Page number")
     * @QueryParam(name="sort", array=true, nullable=true, description="(optional) Sort")
     *
     * @param integer $id
     * @param integer $limit
     * @param integer $offset
     * @param integer $page
     * @param array   $sort
     */
    public function getEvaluationQuestionAction(
        $id,
        $limit  = null,
        $offset = null,
        $page   = null,
        $sort   = null
    )
    {
        try {
            $view = $this->view(
            $this
                ->get('tms_rest.formatter.factory')
                ->create(
                    'orm_collection',
                    $this->getRequest()->get('_route'),
                    $this->getRequest()->getRequestFormat()
                )
                ->setObjectManager(
                    $this->get('doctrine.orm.entity_manager'),
                    $this
                        ->get('tms_faq.manager.question')
                        ->getEntityClass()
                )
                ->addItemRoute(
                    $this
                        ->get('tms_faq.manager.question')
                        ->getEntityClass(),
                    'api_faq_question_get_question'
                )
                ->setCriteria(array(
                    'evaluations' => array(
                        'id' => $id
                    )
                ))
                ->setSort($sort)
                ->setLimit($limit)
                ->setOffset($offset)
                ->setPage($page)
                ->format(),
                Codes::HTTP_OK
            );

            $serializationContext = SerializationContext::create()
                ->setGroups(array(
                    AbstractHypermediaFormatter::SERIALIZER_CONTEXT_GROUP_COLLECTION
                ))
            ;
            $view->setSerializationContext($serializationContext);

            return $this->handleView($view);

        } catch(NotFoundHttpException $e) {
            return $this->handleView($this->view(
                array(),
                $e->getStatusCode()
            ));
        }
    }

    /**
     * [POST] /evaluations
     *
     * Create Evaluations
     */
    public function postEvaluationsAction()
    {
        $datas = $this->get('request')->request->all();

        if (!isset($datas['datas'])) {
            throw new EvaluationException(sprintf(
                'Missing parameters : %s',
                json_encode($datas)
            ));
        }

        $decodedDatas = $this->get('tms_faq.manager.evaluation')->decodeData($datas['datas']);

        try {
            foreach ($decodedDatas as $decodedData) {
                $evaluation = new Evaluation();

                if(!isset($decodedData['question_id']) || !isset($decodedData['value'])) {
                    throw new EvaluationException(sprintf(
                        'Missing parameters : %s',
                        json_encode($datas)
                    ));
                }

                $question = $this->get('tms_faq.manager.question')->findOneById($decodedData['question_id']);
                if (null === $question) {
                    throw new QuestionException(sprintf(
                        'Question entity not found : %s',
                        $decodedData['question_id'])
                    );
                }

                $evaluation
                    ->setQuestion($question)
                    ->setValue(isset($decodedData['value']) ? $decodedData['value'] : null)
                ;

                $this->get('tms_faq.manager.evaluation')->add($evaluation);
            }
        } catch(\Exception $e) {
            return $this->handleView($this->view(
                array('message' => $e->getMessage()),
                Codes::HTTP_INTERNAL_SERVER_ERROR
            ));

        }

        return $this->handleView($this->view(
            null,
            Codes::HTTP_CREATED
        ));
    }
}
