<?php

namespace Gin\Erp\NodesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gin\Erp\NodesBundle\Entity\Node;
use Gin\Erp\NodesBundle\Form\NodeType;

/**
 * Node controller.
 *
 * @Route("/node/admin")
 */
class NodeController extends Controller
{

    /**
     * Lists all Node entities.
     *
     * @Route("/", name="node_admin")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GinErpNodesBundle:Node')->findAll();
        
//        $em->getConnection()->beginTransaction();
//        $em->getConnection()->insert('node_test6', array(
//            'id'=>2
//        ));
////        $em->getConnection()->rollBack();
//        $em->getConnection()->commit();
        
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Node entity.
     *
     * @Route("/", name="node_admin_create")
     * @Method("POST")
     * @Template("GinErpNodesBundle:Node:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Node();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
//            $em->persist($entity);
//            $em->flush();
            $repo=$em->getRepository('GinErpNodesBundle:Node')->createNode($entity);

            return $this->redirect($this->generateUrl('node_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Node entity.
    *
    * @param Node $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Node $entity)
    {
        $form = $this->createForm(new NodeType(), $entity, array(
            'action' => $this->generateUrl('node_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Node entity.
     *
     * @Route("/new", name="node_admin_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Node();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Node entity.
     *
     * @Route("/{id}", name="node_admin_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GinErpNodesBundle:Node')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Node entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Node entity.
     *
     * @Route("/{id}/edit", name="node_admin_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GinErpNodesBundle:Node')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Node entity.');
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
    * Creates a form to edit a Node entity.
    *
    * @param Node $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Node $entity)
    {
        $form = $this->createForm(new NodeType(), $entity, array(
            'action' => $this->generateUrl('node_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Node entity.
     *
     * @Route("/{id}", name="node_admin_update")
     * @Method("PUT")
     * @Template("GinErpNodesBundle:Node:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GinErpNodesBundle:Node')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Node entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('node_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Deletes a Node entity.
     *
     * @Route("/{id}", name="node_admin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GinErpNodesBundle:Node')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Node entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('node'));
    }

    /**
     * Creates a form to delete a Node entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('node_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
