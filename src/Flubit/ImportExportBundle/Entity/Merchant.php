<?php

namespace Flubit\ImportExportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Flubit\ImportExportBundle\Repository\MerchantRepository")
 * 
 * @author Samuel Chiriluta <samuel.chiriluta@gmail.com>
 */
class Merchant {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(length=100, nullable=false, unique=true)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="ProductMerchant", mappedBy="merchant")
     */
    protected $products;

    function __toString()
    {
        return $this->getName() . '';
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
     * Set name
     *
     * @param string $name
     * @return Merchant
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
     * Add products
     *
     * @param \Flubit\ImportExportBundle\Entity\ProductMerchant $products
     * @return Merchant
     */
    public function addProduct(\Flubit\ImportExportBundle\Entity\ProductMerchant $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \Flubit\ImportExportBundle\Entity\ProductMerchant $products
     */
    public function removeProduct(\Flubit\ImportExportBundle\Entity\ProductMerchant $products)
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
