<?php
// src/Phprogress/FormDemoBundle/Controller/DemoClassController.php

namespace Phprogress\FormDemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Phprogress\FormDemoBundle\Entity\DemoClass;
use Phprogress\FormDemoBundle\Form\DemoClassType;

/**
 * DemoClass controller.
 *
 * @Route("/formdemo_crud")
 */
class DemoClassController extends Controller
{
    /**
     * Lists all DemoClass entities.
     *
     * @Route("/", name="formdemo_crud")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PhprogressFormDemoBundle:DemoClass')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a DemoClass entity.
     *
     * @Route("/{id}/show", name="formdemo_crud_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PhprogressFormDemoBundle:DemoClass')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DemoClass entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new DemoClass entity.
     *
     * @Route("/new", name="formdemo_crud_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new DemoClass();
        $form   = $this->createForm(new DemoClassType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new DemoClass entity.
     *
     * @Route("/create", name="formdemo_crud_create")
     * @Method("POST")
     * @Template("PhprogressFormDemoBundle:DemoClass:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new DemoClass();
        $form = $this->createForm(new DemoClassType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formdemo_crud_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing DemoClass entity.
     *
     * @Route("/{id}/edit", name="formdemo_crud_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PhprogressFormDemoBundle:DemoClass')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DemoClass entity.');
        }

        $editForm = $this->createForm(new DemoClassType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing DemoClass entity.
     *
     * @Route("/{id}/update", name="formdemo_crud_update")
     * @Method("POST")
     * @Template("PhprogressFormDemoBundle:DemoClass:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PhprogressFormDemoBundle:DemoClass')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DemoClass entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DemoClassType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formdemo_crud_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a DemoClass entity.
     *
     * @Route("/{id}/delete", name="formdemo_crud_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PhprogressFormDemoBundle:DemoClass')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DemoClass entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('formdemo_crud'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
