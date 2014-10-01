<?php

namespace Flubit\ImportExportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Flubit\ImportExportBundle\Repository\IdentifierRepository")
 * 
 * @author Samuel Chiriluta <samuel.chiriluta@gmail.com>
 */
class Identifier {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(length=10, nullable=false, unique=true)
     */
    protected $code;

    /**
     * @ORM\OneToMany(targetEntity="ProductIdentifier", mappedBy="identifier")
     */
    protected $products;

    function __toString()
    {
        return $this->getCode() . '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set code
     *
     * @param string $code
     * @return Identifier
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add products
     *
     * @param \Flubit\ImportExportBundle\Entity\ProductIdentifier $products
     * @return Identifier
     */
    public function addProduct(\Flubit\ImportExportBundle\Entity\ProductIdentifier $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \Flubit\ImportExportBundle\Entity\ProductIdentifier $products
     */
    public function removeProduct(\Flubit\ImportExportBundle\Entity\ProductIdentifier $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

}
