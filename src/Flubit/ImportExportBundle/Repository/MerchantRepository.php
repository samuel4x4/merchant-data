<?php

namespace Flubit\ImportExportBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Flubit\ImportExportBundle\Entity\Merchant;

/**
 * @author Samuel Chiriluta <samuel.chiriluta@gmail.com>
 */
class MerchantRepository extends EntityRepository {

    public function getExistingOrCreate($name)
    {
        $em = $this->getEntityManager();

        $merchant = $this->findOneByName($name);

        if (is_null($merchant))
        {
            $merchant = new Merchant;
            $merchant->setName($name);

            $em->persist($merchant);
            $em->flush();
        }

        return $merchant;
    }

}
