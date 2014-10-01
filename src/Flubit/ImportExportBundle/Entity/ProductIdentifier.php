<?php

namespace Flubit\ImportExportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Flubit\ImportExportBundle\Repository\ProductIdentifierRepository")
 * 
 * @author Samuel Chiriluta <samuel.chiriluta@gmail.com>
 */
class ProductIdentifier {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="identifiers")
     */
    protected $product;

    /**
     * @ORM\ManyToOne(targetEntity="Identifier", inversedBy="products")
     */
    protected $identifier;

    /**
     * @ORM\Column(length=20, nullable=false)
     */
    protected $value;

    function __toString()
    {
        return $this->getValue() . '';
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
     * Set value
     *
     * @param string $value
     * @return ProductIdentifier
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set product
     *
     * @param \Flubit\ImportExportBundle\Entity\Product $product
     * @return ProductIdentifier
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
     * Set identifier
     *
     * @param \Flubit\ImportExportBundle\Entity\Identifier $identifier
     * @return ProductIdentifier
     */
    public function setIdentifier(\Flubit\ImportExportBundle\Entity\Identifier $identifier = null)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get identifier
     *
     * @return \Flubit\ImportExportBundle\Entity\Identifier 
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

}
