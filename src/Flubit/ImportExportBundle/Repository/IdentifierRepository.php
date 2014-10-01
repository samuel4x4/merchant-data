<?php

namespace Flubit\ImportExportBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Flubit\ImportExportBundle\Entity\Identifier;

/**
 * @author Samuel Chiriluta <samuel.chiriluta@gmail.com>
 */
class IdentifierRepository extends EntityRepository {

    public function getExistingOrCreate($identifiers)
    {
        $em = $this->getEntityManager();

        $result = array();

        $identifiers = explode(",", $identifiers);

        foreach ($identifiers as $identifier)
        {

            $identifierData = explode(":", $identifier);

            $identifier = $this->findOneByCode(trim($identifierData[0]));

            if (is_null($identifier))
            {

                $identifier = new Identifier;
                $identifier->setCode(trim($identifierData[0]));

                $em->persist($identifier);
            }

            $result[] = array(
                'identifier' => $identifier,
                'value' => trim($identifierData[1])
            );
        }

        $em->flush();

        return $result;
    }

}
