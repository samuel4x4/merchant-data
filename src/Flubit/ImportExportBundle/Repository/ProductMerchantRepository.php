<?php

namespace Flubit\ImportExportBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * @author Samuel Chiriluta <samuel.chiriluta@gmail.com>
 */
class ProductMerchantRepository extends EntityRepository {

    public function getProductMerchants($product_id)
    {
        $qb = $this->createQueryBuilder('pm');

        $qb->select('m.name')
                ->leftJoin('pm.merchant', 'm')
                ->where('pm.product = :product_id')
                ->setParameter('product_id', $product_id)
        ;

        return $qb->getQuery()->getArrayResult();
    }

    public function getProductCheapestPrice($product_id)
    {
        $qb = $this->createQueryBuilder('pm');

        $qb->select('pm.price')
                ->leftJoin('pm.merchant', 'm')
                ->where('pm.product = :product_id')
                ->setParameter('product_id', $product_id)
                ->setMaxResults(1)
                ->orderBy('pm.price', 'asc')
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

}
