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
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Util\Codes;
use JMS\Serializer\SerializationContext;
use Tms\Bundle\RestBundle\Formatter\AbstractHypermediaFormatter;

/**
 * Question API REST controller
 */
class ApiQuestionController extends FOSRestController
{
    /**
     * [GET] /questions
     * Retrieve a set of Question
     *
     * @QueryParam(name="faq_id", requirements="\d+", strict=true, nullable=true, description="(optional) Faq id")
     * @QueryParam(name="question_category_id", requirements="\d+", strict=true, nullable=true, description="(optional) Question category id")
     * @QueryParam(name="tags", array=true, nullable=true, description="(optional) Question tags")
     * @QueryParam(name="search", nullable=true, description="(optional) Question full text search")
     * @QueryParam(name="limit", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination limit")
     * @QueryParam(name="offset", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination offset")
     * @QueryParam(name="page", requirements="\d+", strict=true, nullable=true, description="(optional) Page number")
     * @QueryParam(name="sort", array=true, nullable=true, description="(optional) Sort")
     *
     * @param integer $faq_id
     * @param string  $question_category_id
     * @param array   $tags
     * @param string  $search
     * @param integer $limit
     * @param integer $offset
     * @param integer $page
     * @param array   $sort
     */
    public function getQuestionsAction(
        $faq_id               = null,
        $question_category_id = null,
        $tags                 = array(),
        $search               = null,
        $limit                = null,
        $offset               = null,
        $page                 = null,
        $sort                 = null
    )
    {
        $ids = array();
        $elasticaType = $this->get('fos_elastica.index.tms_faq.question');
        $queryBool = new \Elastica\Query\Bool();
        $isQueryable = false;

        if (isset($tags[0])) {
            $isQueryable = true;
            foreach ($tags as $tag) {
                $queryTerm = new \Elastica\Query\Term();
                $queryTerm->setTerm('tagsValue', $tag);
                $queryBool->addShould($queryTerm);
            }
        }

        if (null !== $search) {
            $isQueryable = true;
            $queryString = new \Elastica\Query\QueryString();
            $queryString->setQuery($search);
            $queryBool->addShould($queryString);
        }

        if ($isQueryable) {
            $query = new \Elastica\Query();
            $query->setQuery($queryBool);
            $query->setLimit($limit);

            $resultSet = $elasticaType->search($query);
            foreach ($resultSet as $result) {
                $ids[] = $result->getId();
            }
        }

        $formatter =  $this->get('tms_rest.formatter.factory')
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
            ->setCriteria(array(
                'id'         => $ids,
                'faq'        => $faq_id,
                'categories' => array('id' => $question_category_id)
            ))
            ->setSort($sort)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setPage($page)
        ;

        $view = $this->view(
            $formatter->format(),
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
     * [GET] /questions/{id}
     * Retrieve an Question
     *
     * @Route(requirements={"id" = "\d+"})
     *
     * @param integer $id
     */
    public function getQuestionAction($id)
    {
        try {
            $view = $this->view(
                $this
                    ->get('tms_rest.formatter.factory')
                    ->create(
                        'item',
                        $this->getRequest()->get('_route'),
                        $this->getRequest()->getRequestFormat(),
                        array('id' => $id)
                    )
                    ->setObjectManager(
                        $this->get('doctrine.orm.entity_manager'),
                        $this
                            ->get('tms_faq.manager.question')
                            ->getEntityClass()
                    )
                    ->addEmbedded(
                        'faq',
                        'api_faq_question_get_question_faq'
                    )
                    ->addEmbedded(
                        'categories',
                        'api_faq_question_get_question_questioncategories'
                    )
                    ->addEmbedded(
                        'evaluations',
                        'api_faq_question_get_question_evaluations'
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
     * [GET] /questions/{id}/faq
     * Retrieve faq associated with question
     *
     * @Route(requirements={"id" = "\d+"})
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
    public function getQuestionFaqAction(
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
                            ->get('tms_faq.manager.faq')
                            ->getEntityClass()
                    )
                    ->addItemRoute(
                        $this
                            ->get('tms_faq.manager.faq')
                            ->getEntityClass(),
                        'api_faq_get_faq'
                    )
                    ->setCriteria(array(
                        'questions' => $id
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

        } catch(NotFoundHttpException $e) {
            return $this->handleView($this->view(
                array(),
                $e->getStatusCode()
            ));
        }
    }

    /**
     * [GET] /questions/{id}/questioncategories
     * Retrieve question categories associated with question
     *
     * @Route(requirements={"id" = "\d+"})
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
    public function getQuestionQuestioncategoriesAction(
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
                            ->get('tms_faq.manager.question_category')
                            ->getEntityClass()
                    )
                    ->addItemRoute(
                        $this
                            ->get('tms_faq.manager.question_category')
                            ->getEntityClass(),
                        'api_faq_question_category_get_questioncategory'
                    )
                    ->setCriteria(array(
                        'questions' => $id
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

        } catch(NotFoundHttpException $e) {
            return $this->handleView($this->view(
                array(),
                $e->getStatusCode()
            ));
        }
    }

    /**
     * [GET] /questions/{id}/evaluations
     * Retrieve evaluations of a question
     *
     * @Route(requirements={"id" = "\d+"})
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
    public function getQuestionEvaluationsAction(
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
                            ->get('tms_faq.manager.evaluation')
                            ->getEntityClass()
                    )
                    ->addItemRoute(
                        $this
                            ->get('tms_faq.manager.evaluation')
                            ->getEntityClass(),
                        'api_faq_evaluation_get_evaluation'
                    )
                    ->setCriteria(array(
                        'question' => $id
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

        } catch(NotFoundHttpException $e) {
            return $this->handleView($this->view(
                array(),
                $e->getStatusCode()
            ));
        }
    }

    /**
     * [PATCH] /questions/{id}/yepnope/{value}
     * Update a question entity
     *
     * @patch("/questions/{id}/yepnope/{value}", requirements={"id" = "\d+", "value" = "(yep|nope)"})
     *
     * @param integer $id
     * @param integer $value
     */
    public function patchQuestionYepNopeAction($id, $value)
    {
        $entity = $this->get('tms_faq.manager.question')->findOneById($id);
        if (!$entity) {
            $view = $this->view(
                array('message' => sprintf(
                    'Not found Question entity %s',
                    $id
                )),
                Codes::HTTP_NOT_FOUND
            );

            return $this->handleView($view);
        }

        if ($value === "yep") {
            $entity->addYep();
        } else if ($value === "nope") {
            $entity->addNope();
        }

        $this->get('tms_faq.manager.question')->update($entity);

        return $this->handleView($this->view(array(), codes::HTTP_OK));
    }
}
