<?php

namespace Gin\Erp\NodesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gin\Erp\NodesBundle\Entity\NodeAttribute;
use Gin\Erp\NodesBundle\Form\NodeAttributeType;

/**
 * NodeAttribute controller.
 *
 * @Route("/nodeattr")
 */
class NodeAttributeController extends Controller
{

    /**
     * Lists all NodeAttribute entities.
     *
     * @Route("/", name="nodeattr")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GinErpNodesBundle:NodeAttribute')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new NodeAttribute entity.
     *
     * @Route("/", name="nodeattr_create")
     * @Method("POST")
     * @Template("GinErpNodesBundle:NodeAttribute:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new NodeAttribute();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->getRepository('GinErpNodesBundle:NodeAttribute')->createNodeAttribute($entity);
//            $em->persist($entity);
//            $em->flush();

            return $this->redirect($this->generateUrl('nodeattr_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a NodeAttribute entity.
    *
    * @param NodeAttribute $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(NodeAttribute $entity)
    {
        $form = $this->createForm(new NodeAttributeType(), $entity, array(
            'action' => $this->generateUrl('nodeattr_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new NodeAttribute entity.
     *
     * @Route("/new", name="nodeattr_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new NodeAttribute();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a NodeAttribute entity.
     *
     * @Route("/{id}", name="nodeattr_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GinErpNodesBundle:NodeAttribute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NodeAttribute entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing NodeAttribute entity.
     *
     * @Route("/{id}/edit", name="nodeattr_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GinErpNodesBundle:NodeAttribute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NodeAttribute entity.');
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
    * Creates a form to edit a NodeAttribute entity.
    *
    * @param NodeAttribute $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(NodeAttribute $entity)
    {
        $form = $this->createForm(new NodeAttributeType(), $entity, array(
            'action' => $this->generateUrl('nodeattr_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing NodeAttribute entity.
     *
     * @Route("/{id}", name="nodeattr_update")
     * @Method("PUT")
     * @Template("GinErpNodesBundle:NodeAttribute:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GinErpNodesBundle:NodeAttribute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NodeAttribute entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('nodeattr_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a NodeAttribute entity.
     *
     * @Route("/{id}", name="nodeattr_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GinErpNodesBundle:NodeAttribute')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NodeAttribute entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nodeattr'));
    }

    /**
     * Creates a form to delete a NodeAttribute entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nodeattr_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
