<?php

namespace Tms\Bundle\FaqBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tms\Bundle\FaqBundle\Entity\Faq;
use Tms\Bundle\FaqBundle\Form\FaqType;

/**
 * Faq controller.
 *
 * @Route("/faq")
 */
class FaqController extends Controller
{
    /**
     * Lists all Faq entities.
     *
     * @Route("/", name="tms_faq_faq")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return array(
            'entities' => $this->get('tms_faq.manager.faq')->findAll(),
        );
    }

    /**
     * Creates a new Faq entity.
     *
     * @Route("/", name="tms_faq_faq_create")
     * @Method("POST")
     * @Template("TmsFaqBundle:Faq:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Faq();
        $form = $this->createForm(new FaqType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $this->get('tms_faq.manager.faq')->add($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The faq %object% has been created',
                    array('%object%' => $entity->__toString())
                )
            );

            return $this->redirect($this->generateUrl(
                'tms_faq_faq_show',
                array('id' => $entity->getId())
            ));
        }

        $this->get('session')->getFlashBag()->add(
            'error',
            $this->get('translator')->trans(
                'The faq %object% was not created',
                array('%object%' => $entity->__toString())
            )
        );

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Faq entity.
     *
     * @Route("/new", name="tms_faq_faq_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Faq();
        $form   = $this->createForm(new FaqType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Faq entity.
     *
     * @Route("/{id}", name="tms_faq_faq_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->get('tms_faq.manager.faq')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Faq entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Faq entity.
     *
     * @Route("/{id}/edit", name="tms_faq_faq_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $entity = $this->get('tms_faq.manager.faq')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Faq entity.');
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
     * Edits an existing Faq entity.
     *
     * @Route("/{id}", name="tms_faq_faq_update")
     * @Method("PUT")
     * @Template("TmsFaqBundle:Faq:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->get('tms_faq.manager.faq')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Faq entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FaqType(), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $this->get('tms_faq.manager.faq')->update($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The faq %object% has been updated',
                    array('%object%' => $entity->__toString())
                )
            );

            return $this->redirect($this->generateUrl(
                'tms_faq_faq_edit',
                array('id' => $id)
            ));
        }

        $this->get('session')->getFlashBag()->add(
            'error',
            $this->get('translator')->trans(
                'The Faq %object% was not updated',
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
     * Deletes a Faq entity.
     *
     * @Route("/{id}", name="tms_faq_faq_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $entity = $this->get('tms_faq.manager.faq')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Faq entity.');
            }

            $this->get('tms_faq.manager.faq')->delete($entity);
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans(
                    'The faq %object% has been deleted',
                    array('%object%' => $entity->__toString())
                )
            );
        } else {
            $this->get('session')->getFlashBag()->add(
                'error',
                $this->get('translator')->trans(
                    'The faq %object% was not deleted',
                    array('%object%' => $entity->__toString())
                )
            );
        }

        return $this->redirect($this->generateUrl('tms_faq_faq'));
    }

    /**
     * Creates a form to delete a Faq entity by id.
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