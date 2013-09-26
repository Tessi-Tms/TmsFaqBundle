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
 * QuestionCategory controller.
 *
 * @Route("/questioncategory")
 */
class QuestionCategoryController extends Controller
{

    /**
     * Lists all QuestionCategory entities.
     *
     * @Route("/", name="questioncategory")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TmsFaqBundle:QuestionCategory')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new QuestionCategory entity.
     *
     * @Route("/", name="questioncategory_create")
     * @Method("POST")
     * @Template("TmsFaqBundle:QuestionCategory:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new QuestionCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('questioncategory_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a QuestionCategory entity.
    *
    * @param QuestionCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(QuestionCategory $entity)
    {
        $form = $this->createForm(new QuestionCategoryType(), $entity, array(
            'action' => $this->generateUrl('questioncategory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new QuestionCategory entity.
     *
     * @Route("/new", name="questioncategory_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new QuestionCategory();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a QuestionCategory entity.
     *
     * @Route("/{id}", name="questioncategory_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TmsFaqBundle:QuestionCategory')->find($id);

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
     * @Route("/{id}/edit", name="questioncategory_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TmsFaqBundle:QuestionCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuestionCategory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a QuestionCategory entity.
    *
    * @param QuestionCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(QuestionCategory $entity)
    {
        $form = $this->createForm(new QuestionCategoryType(), $entity, array(
            'action' => $this->generateUrl('questioncategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing QuestionCategory entity.
     *
     * @Route("/{id}", name="questioncategory_update")
     * @Method("PUT")
     * @Template("TmsFaqBundle:QuestionCategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TmsFaqBundle:QuestionCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuestionCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('questioncategory_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a QuestionCategory entity.
     *
     * @Route("/{id}", name="questioncategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TmsFaqBundle:QuestionCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find QuestionCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('questioncategory'));
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
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('questioncategory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
