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
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\Route;
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
        Request $request,
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
                    $request->get('_route'),
                    $request->getRequestFormat()
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
     * @Route(requirements={"id" = "\d+"})
     *
     * @param integer $id
     */
    public function getEvaluationAction(Request $request, $id)
    {
        try {
            $view = $this->view(
                $this
                    ->get('tms_rest.formatter.factory')
                    ->create(
                        'item',
                        $request->get('_route'),
                        $request->getRequestFormat(),
                        array('id' => $id)
                    )
                    ->setObjectManager(
                        $this->get('doctrine.orm.entity_manager'),
                        $this
                            ->get('tms_faq.manager.evaluation')
                            ->getEntityClass()
                    )
                    ->format()
                ,
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
     * [POST] /evaluations
     *
     * Create an Evaluation
     *
     * @RequestParam(name="value", requirements="\d+", nullable=false, description="Offer name")
     * @RequestParam(name="question_id", requirements="\d+", nullable=false, description="Offer name")
     *
     * @param integer $value
     * @param integer $question_id
     */
    public function postEvaluationsAction($value, $question_id)
    {
        try {
            $question = $this->get('tms_faq.manager.question')->findOneById($question_id);
            if (null === $question) {
                return $this->handleView($this->view(
                    array('message' => sprintf(
                        'Not found Question entity (id : %s) to associated with this Evaluation.',
                        $question_id
                    )),
                    Codes::HTTP_NOT_FOUND
                ));
            }
            $evaluation = new Evaluation();
            $evaluation
                ->setQuestion($question)
                ->setValue($value)
            ;

            $this->get('tms_faq.manager.evaluation')->add($evaluation);

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
