<?php

namespace Tms\Bundle\FaqBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tms\Bundle\FaqBundle\Entity\FaqResponse;
use Tms\Bundle\FaqBundle\Form\FaqResponseType;

/**
 * FaqResponse controller.
 *
 * @Route("/faqresponse")
 */
class FaqResponseController extends Controller
{
    /**
     * Lists all FaqResponse entities.
     *
     * @Route("/", name="tms_faq_faq-response")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return array(
            'entities' => $this->get('tms_faq.manager.faq_response')->findAll(),
        );
    }

    /**
     * Creates a new FaqResponse entity.
     *
     * @Route("/", name="tms_faq_faq-response_create")
     * @Method("POST")
     * @Template("TmsFaqBundle:FaqResponse:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new FaqResponse();
        $form = $this->createForm(new FaqResponseType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $this->get('tms_faq.manager.faq_response')->add($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The faq response %object% has been created',
                    array('%object%' => $entity->__toString())
                )
            );

            return $this->redirect($this->generateUrl(
                'tms_faq_faq-response_show',
                array('id' => $entity->getId())
            ));
        }

        $this->get('session')->getFlashBag()->add(
            'error',
            $this->get('translator')->trans(
                'The faq response %object% was not created',
                array('%object%' => $entity->__toString())
            )
        );

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new FaqResponse entity.
     *
     * @Route("/new", name="tms_faq_faq-response_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new FaqResponse();
        $form   = $this->createForm(new FaqResponseType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a FaqResponse entity.
     *
     * @Route("/{id}", name="tms_faq_faq-response_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->get('tms_faq.manager.faq_response')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FaqResponse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing FaqResponse entity.
     *
     * @Route("/{id}/edit", name="tms_faq_faq-response_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $entity = $this->get('tms_faq.manager.faq_response')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FaqResponse entity.');
        }

        $editForm = $this->createForm(new FaqResponseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing FaqResponse entity.
     *
     * @Route("/{id}", name="tms_faq_faq-response_update")
     * @Method("PUT")
     * @Template("TmsFaqBundle:FaqResponse:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->get('tms_faq.manager.faq_response')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FaqResponse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FaqResponseType(), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $this->get('tms_faq.manager.faq_response')->update($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The faq response %object% has been updated',
                    array('%object%' => $entity->__toString())
                )
            );

            return $this->redirect($this->generateUrl(
                'tms_faq_faq-response_edit',
                array('id' => $id)
            ));
        }

        $this->get('session')->getFlashBag()->add(
            'error',
            $this->get('translator')->trans(
                'The Faq response %object% was not updated',
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
     * Deletes a FaqResponse entity.
     *
     * @Route("/{id}", name="tms_faq_faq-response_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $entity = $this->get('tms_faq.manager.faq_response')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FaqResponse entity.');
            }

            $this->get('tms_faq.manager.faq_response')->delete($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The faq response %object% has been deleted',
                    array('%object%' => $entity->__toString())
                )
            );
        } else {
            $this->get('session')->getFlashBag()->add(
                'error',
                $this->get('translator')->trans(
                    'The faq response %object% was not deleted',
                    array('%object%' => $entity->__toString())
                )
            );
        }

        return $this->redirect($this->generateUrl('tms_faq_faq-response'));
    }

    /**
     * Creates a form to delete a FaqResponse entity by id.
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
