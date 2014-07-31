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
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Util\Codes;
use JMS\Serializer\SerializationContext;
use Tms\Bundle\RestBundle\Formatter\AbstractHypermediaFormatter;

/**
 * QuestionCategory API REST controller
 */
class ApiQuestionCategoryController extends FOSRestController
{
    /**
     * [GET] /questioncategories
     * Retrieve a set of QuestionCategory
     *
     * @QueryParam(name="faq_id", requirements="\d+", nullable=true, description="(optional) faq id")
     * @QueryParam(name="limit", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination limit")
     * @QueryParam(name="offset", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination offset")
     * @QueryParam(name="page", requirements="\d+", strict=true, nullable=true, description="(optional) Page number")
     * @QueryParam(name="sort", array=true, nullable=true, description="(optional) Sort")
     *
     * @param integer $faq_id
     * @param integer $limit
     * @param integer $offset
     * @param integer $page
     * @param array   $sort
     */
    public function getQuestioncategoriesAction(
        $faq_id     = null,
        $limit      = null,
        $offset     = null,
        $page       = null,
        $sort       = null
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
                        ->get('tms_faq.manager.question_category')
                        ->getEntityClass()
                )
                ->setCriteria(array(
                    'faq' => $faq_id
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
     * [GET] /questioncategories/{id}
     * Retrieve an QuestionCategory
     *
     * @Route(requirements={"id" = "\d+"})
     *
     * @param integer $id
     */
    public function getQuestioncategoryAction($id)
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
                            ->get('tms_faq.manager.question_category')
                            ->getEntityClass()
                    )
                    ->addEmbedded(
                        'faq',
                        'api_faq_question_category_get_questioncategory_faq'
                    )
                    ->addEmbedded(
                        'questions',
                        'api_faq_question_category_get_questioncategory_questions'
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
     * [GET] /questioncategories/{id}/faq
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
    public function getQuestioncategoryFaqAction(
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
                        'categories' => array(
                            'id' => $id
                        )
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
     * [GET] /questioncategories/{id}/questions
     * Retrieve questions of a question category
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
    public function getQuestioncategoryQuestionsAction(
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
                        'categories' => array(
                            'id' => $id
                        )
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
}
