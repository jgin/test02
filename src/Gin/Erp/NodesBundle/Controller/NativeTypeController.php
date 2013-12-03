<?php

namespace Gin\Erp\NodesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gin\Erp\NodesBundle\Entity\NativeType;
use Gin\Erp\NodesBundle\Form\NativeTypeType;

/**
 * NativeType controller.
 *
 * @Route("/nativetype")
 */
class NativeTypeController extends Controller
{

    /**
     * Lists all NativeType entities.
     *
     * @Route("/", name="nativetype")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GinErpNodesBundle:NativeType')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new NativeType entity.
     *
     * @Route("/", name="nativetype_create")
     * @Method("POST")
     * @Template("GinErpNodesBundle:NativeType:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new NativeType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nativetype_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a NativeType entity.
    *
    * @param NativeType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(NativeType $entity)
    {
        $form = $this->createForm(new NativeTypeType(), $entity, array(
            'action' => $this->generateUrl('nativetype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new NativeType entity.
     *
     * @Route("/new", name="nativetype_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new NativeType();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a NativeType entity.
     *
     * @Route("/{id}", name="nativetype_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GinErpNodesBundle:NativeType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NativeType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing NativeType entity.
     *
     * @Route("/{id}/edit", name="nativetype_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GinErpNodesBundle:NativeType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NativeType entity.');
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
    * Creates a form to edit a NativeType entity.
    *
    * @param NativeType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(NativeType $entity)
    {
        $form = $this->createForm(new NativeTypeType(), $entity, array(
            'action' => $this->generateUrl('nativetype_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing NativeType entity.
     *
     * @Route("/{id}", name="nativetype_update")
     * @Method("PUT")
     * @Template("GinErpNodesBundle:NativeType:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GinErpNodesBundle:NativeType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NativeType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('nativetype_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a NativeType entity.
     *
     * @Route("/{id}", name="nativetype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GinErpNodesBundle:NativeType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NativeType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nativetype'));
    }

    /**
     * Creates a form to delete a NativeType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nativetype_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
