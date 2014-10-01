<?php

namespace Flubit\ImportExportBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Flubit\ImportExportBundle\Entity\Product;

/**
 * multiple images
 * 
 * @author Samuel Chiriluta <samuel.chiriluta@gmail.com>
 */
class ProductRepository extends EntityRepository {

    public function getExistingOrCreate($title, $image)
    {
        $em = $this->getEntityManager();

        $product = $this->findOneByTitle($title);

        if (is_null($product))
        {
            $product = new Product;
            $product->setTitle($title);
            $product->setImage($image);

            $em->persist($product);
            $em->flush();
        }

        return $product;
    }

}
