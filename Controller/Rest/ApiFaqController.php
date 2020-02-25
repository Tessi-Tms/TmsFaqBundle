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
 * Faq API REST controller
 */
class ApiFaqController extends FOSRestController
{
    /**
     * [GET] /faqs
     * Retrieve a set of Faq
     *
     * @QueryParam(name="enabled", requirements="[0,1]", nullable=true, description="(optional) enabled Customer")
     * @QueryParam(name="limit", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination limit")
     * @QueryParam(name="offset", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination offset")
     * @QueryParam(name="page", requirements="\d+", strict=true, nullable=true, description="(optional) Page number")
     * @QueryParam(name="sort", array=true, nullable=true, description="(optional) Sort")
     *
     * @param string  $enabled
     * @param integer $limit
     * @param integer $offset
     * @param integer $page
     * @param array   $sort
     */
    public function getFaqsAction(
        Request $request,
        $enabled     = null,
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
                        ->get('tms_faq.manager.faq')
                        ->getEntityClass()
                )
                ->setCriteria(array(
                    'enabled' => isset($enabled) ? (bool)$enabled : null
                ))
                ->setExtraQuery(array(
                    'enabled' => isset($enabled) ? (bool)$enabled : null
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
     * @Route(requirements={"id" = "\d+"})
     *
     * @param integer $id
     */
    public function getFaqAction(Request $request, $id)
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
     * [GET] /faqs/{id}/questioncategories
     * Retrieve question categories of a faq
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
    public function getFaqQuestioncategoriesAction(
        Request $request,
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
                        $request->get('_route'),
                        $request->getRequestFormat(),
                        array('id' => $id)
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
                        'api_faq_get_faq_questioncategory',
                        array('faq_id' => $id)
                    )
                    ->setCriteria(array(
                        'faq' => $id
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
     * [GET] /faqs/{faq_id}/questioncategories/{id}
     * Retrieve a question category of a faq
     *
     * @Route(requirements={"faq_id" = "\d+", "id" = "\d+"})
     *
     * @param integer $faq_id
     * @param integer $id
     */
    public function getFaqQuestioncategoryAction(Request $request, $faq_id, $id)
    {
        try {
            $view = $this->view(
                $this
                    ->get('tms_rest.formatter.factory')
                    ->create(
                        'item',
                        $request->get('_route'),
                        $request->getRequestFormat(),
                        array(
                            'faq_id' => $faq_id,
                            'id'     => $id,
                        ),
                        array('id' => $id)
                    )
                    ->setObjectManager(
                        $this->get('doctrine.orm.entity_manager'),
                        $this
                            ->get('tms_faq.manager.question_category')
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
     * [GET] /faqs/{id}/questions
     * Retrieve question of a faq
     *
     * @Route(requirements={"id" = "\d+"})
     *
     * @QueryParam(name="question_category_id", requirements="\d+", strict=true, nullable=true, description="(optional) Question category id")
     * @QueryParam(name="tags", array=true, nullable=true, description="(optional) Question tags")
     * @QueryParam(name="search", nullable=true, description="(optional) Question full text search")
     * @QueryParam(name="limit", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination limit")
     * @QueryParam(name="offset", requirements="\d+", strict=true, nullable=true, description="(optional) Pagination offset")
     * @QueryParam(name="page", requirements="\d+", strict=true, nullable=true, description="(optional) Page number")
     * @QueryParam(name="sort", array=true, nullable=true, description="(optional) Sort")
     *
     * @param integer $id
     * @param string  $question_category_id
     * @param array   $tags
     * @param string  $search
     * @param integer $limit
     * @param integer $offset
     * @param integer $page
     * @param array   $sort
     */
    public function getFaqQuestionsAction(
        Request $request,
        $id,
        $question_category_id = null,
        $tags                 = array(),
        $search               = null,
        $limit                = null,
        $offset               = null,
        $page                 = null,
        $sort                 = null
    )
    {
        try {
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
                $query->setSize($limit);

                $resultSet = $elasticaType->search($query);
                foreach ($resultSet as $result) {
                    $ids[] = $result->getId();
                }
            }

            $view = $this->view(
                $this
                    ->get('tms_rest.formatter.factory')
                    ->create(
                        'orm_collection',
                        $request->get('_route'),
                        $request->getRequestFormat(),
                        array('id' => $id)
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
                        'id'         => $ids,
                        'faq'        => $id,
                        'categories' => array('id' => $question_category_id)
                    ))
                    ->setExtraQuery(array(
                        'tags'   => $tags,
                        'search' => $search,
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
     * [GET] /faqs/{faq_id}/questions/{id}
     * Retrieve a Question of a faq
     *
     * @Route(requirements={"faq_id" = "\d+", "id" = "\d+"})
     *
     * @param integer $id
     */
    public function getFaqQuestionAction(Request $request, $faq_id, $id)
    {
        try {
            $view = $this->view(
                $this
                    ->get('tms_rest.formatter.factory')
                    ->create(
                        'item',
                        $request->get('_route'),
                        $request->getRequestFormat(),
                        array(
                            'faq_id' => $faq_id,
                            'id'     => $id,
                        )
                    )
                    ->setObjectManager(
                        $this->get('doctrine.orm.entity_manager'),
                        $this
                            ->get('tms_faq.manager.question')
                            ->getEntityClass()
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
}
