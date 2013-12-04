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
 * @Route("/node")
 */
class NodeController extends Controller
{

    /**
     * Lists all Node entities.
     *
     * @Route("/", name="node")
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
     * Finds and displays a Node entity.
     *
     * @Route("/{nodeName}")
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

}
