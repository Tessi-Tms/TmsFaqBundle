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

/**
 * Faq API REST controller
 */
class ApiFaqController extends FOSRestController
{
    /**
     * [GET] /faqs
     * Retrieve a set of Faq
     *
     * @QueryParam(name="customer_id", nullable=true, description="(optional) Customer")
     * @QueryParam(name="limit", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination limit")
     * @QueryParam(name="offset", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination offset")
     * @QueryParam(name="page", requirements="\d+", strict=true, nullable=true, description="(optional) Page number")
     * @QueryParam(name="sort", array=true, nullable=true, description="(optional) Sort")
     *
     * @param integer $customer_id
     * @param integer $limit
     * @param integer $offset
     * @param integer $page
     * @param array   $sort
     */
    public function getFaqsAction(
        $customer_id = null,
        $limit       = null,
        $offset      = null,
        $page        = null,
        $sort        = null
    )
    {
        $hash = null;
        if (null !== $customer_id) {
            $customer = $this->get('tms_operation.manager.customer')->findOneById($customer_id);
            if (null !== $customer) {
                $hash = $this->get('tms_faq.manager.faq')->generateHash($customer);
            }
        }

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
                ->setCriteria(array(
                    'hash' => $hash
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
     * [GET] /faqs/{id}
     * Retrieve a Faq
     *
     * @param integer $id
     */
    public function getFaqAction($id)
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
                        ->get('tms_faq.manager.faq')
                        ->getEntityClass()
                )
                ->addEmbedded(
                    'categories',
                    'api_faq_get_faq_questioncategories'
                )
                ->addEmbedded(
                    'questions',
                    'api_faq_get_faq_questions'
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
     * [GET] /faqs/{id}/questioncategories
     * Retrieve question categories of a faq
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
    public function getFaqQuestioncategoriesAction(
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
                    'faq' => array(
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
     * [GET] /faqs/{id}/questions
     * Retrieve question of a faq
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
    public function getFaqQuestionsAction(
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
                    'faq' => array(
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
}
