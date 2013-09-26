<?php

namespace Tms\Bundle\FaqBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tms\Bundle\FaqBundle\Entity\FaqQuestionCategory;
use Tms\Bundle\FaqBundle\Form\FaqQuestionCategoryType;

/**
 * FaqQuestionCategory controller.
 *
 * @Route("/questioncatergory")
 */
class FaqQuestionCategoryController extends Controller
{
    /**
     * Lists all FaqQuestionCategory entities.
     *
     * @Route("/", name="tms_faq_faq-question-category")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return array(
            'entities' => $this->get('tms_faq.manager.faq_question_category')->findAll(),
        );
    }

    /**
     * Creates a new Faq entity.
     *
     * @Route("/", name="tms_faq_faq-question-category_create")
     * @Method("POST")
     * @Template("TmsFaqBundle:FaqQuestionCategory:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new FaqQuestionCategory();
        $form = $this->createForm(new FaqQuestionCategoryType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $this->get('tms_faq.manager.faq_question_category')->add($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The faq question category %object% has been created',
                    array('%object%' => $entity->__toString())
                )
            );

            return $this->redirect($this->generateUrl(
                'tms_faq_faq-question-category_show',
                array('id' => $entity->getId())
            ));
        }

        $this->get('session')->getFlashBag()->add(
            'error',
            $this->get('translator')->trans(
                'The faq question category %object% was not created',
                array('%object%' => $entity->__toString())
            )
        );

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new FaqQuestionCategory entity.
     *
     * @Route("/new", name="tms_faq_faq-question-category_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new FaqQuestionCategory();
        $form   = $this->createForm(new FaqQuestionCategoryType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a FaqQuestionCategory entity.
     *
     * @Route("/{id}", name="tms_faq_faq-question-category_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->get('tms_faq.manager.faq_question_category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FaqQuestionCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing FaqQuestionCategory entity.
     *
     * @Route("/{id}/edit", name="tms_faq_faq-question-category_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $entity = $this->get('tms_faq.manager.faq_question_category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FaqQuestionCategory entity.');
        }

        $editForm = $this->createForm(new FaqQuestionCategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing FaqQuestionCategory entity.
     *
     * @Route("/{id}", name="tms_faq_faq-question-category_update")
     * @Method("PUT")
     * @Template("TmsFaqBundle:FaqQuestionCategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->get('tms_faq.manager.faq_question_category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FaqQuestionCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FaqQuestionCategoryType(), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $this->get('tms_faq.manager.faq_question_category')->update($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The faq question category %object% has been updated',
                    array('%object%' => $entity->__toString())
                )
            );

            return $this->redirect($this->generateUrl(
                'tms_faq_faq-question-category_edit',
                array('id' => $id)
            ));
        }

        $this->get('session')->getFlashBag()->add(
            'error',
            $this->get('translator')->trans(
                'The faq question category %object% was not updated',
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
     * Deletes a FaqQuestionCategory entity.
     *
     * @Route("/{id}", name="tms_faq_faq-question-category_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $entity = $this->get('tms_faq.manager.faq_question_category')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FaqQuestionCategory entity.');
            }

            $this->get('tms_faq.manager.faq_question_category')->delete($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The faq question category %object% has been deleted',
                    array('%object%' => $entity->__toString())
                )
            );
        } else {
            $this->get('session')->getFlashBag()->add(
                'error',
                $this->get('translator')->trans(
                    'The faq question category %object% was not deleted',
                    array('%object%' => $entity->__toString())
                )
            );
        }

        return $this->redirect($this->generateUrl('tms_faq_faq-question-category'));
    }

    /**
     * Creates a form to delete a FaqQuestionCategory entity by id.
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
