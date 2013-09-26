<?php

namespace Tms\Bundle\FaqBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tms\Bundle\FaqBundle\Entity\FaqQuestion;
use Tms\Bundle\FaqBundle\Form\FaqQuestionType;

/**
 * FaqQuestion controller.
 *
 * @Route("/faqquestion")
 */
class FaqQuestionController extends Controller
{
    /**
     * Lists all FaqQuestion entities.
     *
     * @Route("/", name="tms_faq_faq-question")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return array(
            'entities' => $this->get('tms_faq.manager.faq_question')->findAll(),
        );
    }

    /**
     * Creates a new FaqQuestion entity.
     *
     * @Route("/", name="tms_faq_faq-question_create")
     * @Method("POST")
     * @Template("TmsFaqBundle:FaqQuestion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new FaqQuestion();
        $form = $this->createForm(new FaqQuestionType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $this->get('tms_faq.manager.faq_question')->add($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The faq question %object% has been created',
                    array('%object%' => $entity->__toString())
                )
            );

            return $this->redirect($this->generateUrl(
                'tms_faq_faq-question_show',
                array('id' => $entity->getId())
            ));
        }

        $this->get('session')->getFlashBag()->add(
            'error',
            $this->get('translator')->trans(
                'The faq question %object% was not created',
                array('%object%' => $entity->__toString())
            )
        );

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new FaqQuestion entity.
     *
     * @Route("/new", name="tms_faq_faq-question_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new FaqQuestion();
        $form   = $this->createForm(new FaqQuestionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a FaqQuestion entity.
     *
     * @Route("/{id}", name="tms_faq_faq-question_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->get('tms_faq.manager.faq_question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FaqQuestion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing FaqQuestion entity.
     *
     * @Route("/{id}/edit", name="tms_faq_faq-question_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $entity = $this->get('tms_faq.manager.faq_question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FaqQuestion entity.');
        }

        $editForm = $this->createForm(new FaqType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing FaqQuestion entity.
     *
     * @Route("/{id}", name="tms_faq_faq-question_update")
     * @Method("PUT")
     * @Template("TmsFaqBundle:FaqQuestion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->get('tms_faq.manager.faq_question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FaqQuestion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FaqQuestionType(), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $this->get('tms_faq.manager.faq_question')->update($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The faq question %object% has been updated',
                    array('%object%' => $entity->__toString())
                )
            );

            return $this->redirect($this->generateUrl(
                'tms_faq_faq-question_edit',
                array('id' => $id)
            ));
        }

        $this->get('session')->getFlashBag()->add(
            'error',
            $this->get('translator')->trans(
                'The faq question %object% was not updated',
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
     * Deletes a FaqQuestion entity.
     *
     * @Route("/{id}", name="tms_faq_faq-question_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $entity = $this->get('tms_faq.manager.faq_question')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FaqQuestion entity.');
            }

            $this->get('tms_faq.manager.faq_question')->delete($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The faq question %object% has been deleted',
                    array('%object%' => $entity->__toString())
                )
            );
        } else {
            $this->get('session')->getFlashBag()->add(
                'error',
                $this->get('translator')->trans(
                    'The faq question %object% was not deleted',
                    array('%object%' => $entity->__toString())
                )
            );
        }

        return $this->redirect($this->generateUrl('tms_faq_faq-question'));
    }

    /**
     * Creates a form to delete a FaqQuestion entity by id.
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
