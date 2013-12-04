<?php

namespace Gin\Erp\NodesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NodeAttribute
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gin\Erp\NodesBundle\Repository\NodeAttributeRepository")
 */
class NodeAttribute
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @var Node
     * 
     * @ORM\ManyToOne(targetEntity="Node")
     * @ORM\JoinColumn(name="nodeId", referencedColumnName="id")
     */
    private $node;
    
    /**
     * @var Node
     * 
     * @ORM\ManyToOne(targetEntity="Node")
     * @ORM\JoinColumn(name="nodeTypeId", referencedColumnName="id")
     */
    private $nodeType;
    
    /**
     * @var NativeType
     * 
     * @ORM\ManyToOne(targetEntity="NativeType")
     * @ORM\JoinColumn(name="nativeTypeId", referencedColumnName="id")
     */
    private $nativeType;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $caption;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set name
     *
     * @param string $name
     * @return NodeAttribute
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set node
     *
     * @param \Gin\Erp\NodesBundle\Entity\Node $node
     * @return NodeAttribute
     */
    public function setNode(\Gin\Erp\NodesBundle\Entity\Node $node = null)
    {
        $this->node = $node;
    
        return $this;
    }

    /**
     * Get node
     *
     * @return \Gin\Erp\NodesBundle\Entity\Node 
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * Set nodeType
     *
     * @param \Gin\Erp\NodesBundle\Entity\Node $nodeType
     * @return NodeAttribute
     */
    public function setNodeType(\Gin\Erp\NodesBundle\Entity\Node $nodeType = null)
    {
        $this->nodeType = $nodeType;
    
        return $this;
    }

    /**
     * Get nodeType
     *
     * @return \Gin\Erp\NodesBundle\Entity\Node 
     */
    public function getNodeType()
    {
        return $this->nodeType;
    }

    /**
     * Set nativeType
     *
     * @param \Gin\Erp\NodesBundle\Entity\NativeType $nativeType
     * @return NodeAttribute
     */
    public function setNativeType(\Gin\Erp\NodesBundle\Entity\NativeType $nativeType = null)
    {
        $this->nativeType = $nativeType;
    
        return $this;
    }

    /**
     * Get nativeType
     *
     * @return \Gin\Erp\NodesBundle\Entity\NativeType 
     */
    public function getNativeType()
    {
        return $this->nativeType;
    }

    /**
     * Set caption
     *
     * @param string $caption
     * @return NodeAttribute
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
    
        return $this;
    }

    /**
     * Get caption
     *
     * @return string 
     */
    public function getCaption()
    {
        return $this->caption;
    }
}