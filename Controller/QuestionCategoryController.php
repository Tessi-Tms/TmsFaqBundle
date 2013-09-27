<?php

namespace Tms\Bundle\FaqBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tms\Bundle\FaqBundle\Entity\QuestionCategory;
use Tms\Bundle\FaqBundle\Form\QuestionCategoryType;

/**
 * FaqQuestionCategory controller.
 *
 * @Route("/questioncatergory")
 */
class QuestionCategoryController extends Controller
{
    /**
     * Lists all QuestionCategory entities.
     *
     * @Route("/", name="tms_faq_question-category")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return array(
            'entities' => $this->get('tms_faq.manager.question_category')->findAll(),
        );
    }

    /**
     * Creates a new QuestionCategory entity.
     *
     * @Route("/", name="tms_faq_question-category_create")
     * @Method("POST")
     * @Template("TmsFaqBundle:QuestionCategory:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new QuestionCategory();
        $form = $this->createForm(new QuestionCategoryType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $this->get('tms_faq.manager.question_category')->add($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The question category question category %object% has been created',
                    array('%object%' => $entity->__toString())
                )
            );

            return $this->redirect($this->generateUrl(
                'tms_faq_question-category_show',
                array('id' => $entity->getId())
            ));
        }

        $this->get('session')->getFlashBag()->add(
            'error',
            $this->get('translator')->trans(
                'The question category %object% was not created',
                array('%object%' => $entity->__toString())
            )
        );

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new QuestionCategory entity.
     *
     * @Route("/new", name="tms_faq_question-category_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new QuestionCategory();
        $form   = $this->createForm(new QuestionCategoryType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a QuestionCategory entity.
     *
     * @Route("/{id}", name="tms_faq_question-category_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->get('tms_faq.manager.question_category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuestionCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing QuestionCategory entity.
     *
     * @Route("/{id}/edit", name="tms_faq_question-category_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $entity = $this->get('tms_faq.manager.question_category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuestionCategory entity.');
        }

        $editForm = $this->createForm(new QuestionCategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing QuestionCategory entity.
     *
     * @Route("/{id}", name="tms_faq_question-category_update")
     * @Method("PUT")
     * @Template("TmsFaqBundle:QuestionCategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->get('tms_faq.manager.question_category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuestionCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new QuestionCategoryType(), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $this->get('tms_faq.manager.question_category')->update($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The question category %object% has been updated',
                    array('%object%' => $entity->__toString())
                )
            );

            return $this->redirect($this->generateUrl(
                'tms_faq_question-category_edit',
                array('id' => $id)
            ));
        }

        $this->get('session')->getFlashBag()->add(
            'error',
            $this->get('translator')->trans(
                'The question category %object% was not updated',
                array('%object%' => $entity->__toString())
            )
        );

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a QuestionCategory entity.
     *
     * @Route("/{id}", name="tms_faq_question-category_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $entity = $this->get('tms_faq.manager.question_category')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find QuestionCategory entity.');
            }

            $this->get('tms_faq.manager.question_category')->delete($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The question category %object% has been deleted',
                    array('%object%' => $entity->__toString())
                )
            );
        } else {
            $this->get('session')->getFlashBag()->add(
                'error',
                $this->get('translator')->trans(
                    'The question category %object% was not deleted',
                    array('%object%' => $entity->__toString())
                )
            );
        }

        return $this->redirect($this->generateUrl('tms_faq_question-category'));
    }

    /**
     * Creates a form to delete a QuestionCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
