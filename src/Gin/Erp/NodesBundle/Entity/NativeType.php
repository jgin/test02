<?php

namespace Gin\Erp\NodesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NativeType
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gin\Erp\NodesBundle\Repository\NativeTypeRepository")
 */
class NativeType
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
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $caption;

    
    public function __toString() {
        if (empty($this->caption)) {
            return $this->getName();
        } else {
            return $this->getCaption();
        }
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
     * @return NativeType
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
     * Set caption
     *
     * @param string $caption
     * @return NativeType
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