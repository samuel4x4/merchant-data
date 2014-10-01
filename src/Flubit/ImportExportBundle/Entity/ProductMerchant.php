<?php

namespace Flubit\ImportExportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Flubit\ImportExportBundle\Repository\ProductMerchantRepository")
 * 
 * @author Samuel Chiriluta <samuel.chiriluta@gmail.com>
 */
class ProductMerchant {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="merchants")
     */
    protected $product;

    /**
     * @ORM\ManyToOne(targetEntity="Merchant", inversedBy="products")
     */
    protected $merchant;

    /**
     * @ORM\Column(type="decimal", nullable=false, precision=6, scale=2)
     */
    protected $price;

    function __toString()
    {
        return $this->getId() . '';
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
     * Set price
     *
     * @param string $price
     * @return ProductMerchant
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set product
     *
     * @param \Flubit\ImportExportBundle\Entity\Product $product
     * @return ProductMerchant
     */
    public function setProduct(\Flubit\ImportExportBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Flubit\ImportExportBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set merchant
     *
     * @param \Flubit\ImportExportBundle\Entity\Merchant $merchant
     * @return ProductMerchant
     */
    public function setMerchant(\Flubit\ImportExportBundle\Entity\Merchant $merchant = null)
    {
        $this->merchant = $merchant;

        return $this;
    }

    /**
     * Get merchant
     *
     * @return \Flubit\ImportExportBundle\Entity\Merchant 
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

}
