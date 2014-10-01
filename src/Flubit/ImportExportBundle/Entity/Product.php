<?php

namespace Flubit\ImportExportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Flubit\ImportExportBundle\Repository\ProductRepository")
 * 
 * @author Samuel Chiriluta <samuel.chiriluta@gmail.com>
 */
class Product {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(length=100, nullable=false, unique=true)
     */
    protected $title;

    /**
     * @ORM\Column(length=80, nullable=false)
     */
    protected $image;

    /**
     * @ORM\OneToMany(targetEntity="ProductMerchant", mappedBy="product")
     */
    protected $merchants;

    /**
     * @ORM\OneToMany(targetEntity="ProductIdentifier", mappedBy="product")
     */
    protected $identifiers;

    function __toString()
    {
        return $this->getTitle() . '';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->merchants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->identifiers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add merchants
     *
     * @param \Flubit\ImportExportBundle\Entity\ProductMerchant $merchants
     * @return Product
     */
    public function addMerchant(\Flubit\ImportExportBundle\Entity\ProductMerchant $merchants)
    {
        $this->merchants[] = $merchants;

        return $this;
    }

    /**
     * Remove merchants
     *
     * @param \Flubit\ImportExportBundle\Entity\ProductMerchant $merchants
     */
    public function removeMerchant(\Flubit\ImportExportBundle\Entity\ProductMerchant $merchants)
    {
        $this->merchants->removeElement($merchants);
    }

    /**
     * Get merchants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMerchants()
    {
        return $this->merchants;
    }

    /**
     * Add identifiers
     *
     * @param \Flubit\ImportExportBundle\Entity\ProductIdentifier $identifiers
     * @return Product
     */
    public function addIdentifier(\Flubit\ImportExportBundle\Entity\ProductIdentifier $identifiers)
    {
        $this->identifiers[] = $identifiers;

        return $this;
    }

    /**
     * Remove identifiers
     *
     * @param \Flubit\ImportExportBundle\Entity\ProductIdentifier $identifiers
     */
    public function removeIdentifier(\Flubit\ImportExportBundle\Entity\ProductIdentifier $identifiers)
    {
        $this->identifiers->removeElement($identifiers);
    }

    /**
     * Get identifiers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdentifiers()
    {
        return $this->identifiers;
    }

}
