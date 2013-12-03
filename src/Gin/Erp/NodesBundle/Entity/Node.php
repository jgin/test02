<?php

namespace Gin\Erp\NodesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Node
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gin\Erp\NodesBundle\Repository\NodeRepository")
 */
class Node
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="NodeAttribute", mappedBy="nodeType")
     */
    private $attributes;
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attributes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @return Node
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
     * Add attributes
     *
     * @param \Gin\Erp\NodesBundle\Entity\NodeAttribute $attributes
     * @return Node
     */
    public function addAttribute(\Gin\Erp\NodesBundle\Entity\NodeAttribute $attributes)
    {
        $this->attributes[] = $attributes;
    
        return $this;
    }

    /**
     * Remove attributes
     *
     * @param \Gin\Erp\NodesBundle\Entity\NodeAttribute $attributes
     */
    public function removeAttribute(\Gin\Erp\NodesBundle\Entity\NodeAttribute $attributes)
    {
        $this->attributes->removeElement($attributes);
    }

    /**
     * Get attributes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}