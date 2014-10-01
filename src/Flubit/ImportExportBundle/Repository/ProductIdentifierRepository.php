<?php

namespace Flubit\ImportExportBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * @author Samuel Chiriluta <samuel.chiriluta@gmail.com>
 */
class ProductIdentifierRepository extends EntityRepository {

    public function getProductIdentifiers($product_id)
    {
        $qb = $this->createQueryBuilder('pi');

        $qb->select('i.code, pi.value')
                ->leftJoin('pi.identifier', 'i')
                ->where('pi.product = :product_id')
                ->setParameter('product_id', $product_id)
        ;

        return $qb->getQuery()->getArrayResult();
    }

}
