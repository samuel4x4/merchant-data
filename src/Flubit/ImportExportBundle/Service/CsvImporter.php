<?php

namespace Flubit\ImportExportBundle\Service;

use Flubit\ImportExportBundle\Entity\ProductMerchant;
use Flubit\ImportExportBundle\Entity\ProductIdentifier;

/**
 * @author Samuel Chiriluta <samuel.chiriluta@gmail.com>
 */
class CsvImporter {

    private $entityManager;

    const COLUMN_MERCHANT_NAME = 0;
    const COLUMN_PRICE = 1;
    const COLUMN_IDENTIFIERS = 2;
    const COLUMN_IMAGE = 3;
    const COLUMN_PRODUCT_TITLE = 4;

    public function __construct($entity_manager)
    {
        $this->entityManager = $entity_manager;
    }

    public function import($filePath)
    {
        $handle = fopen($filePath, 'r');

        $parsedProducts = 0;

        while (($line = fgetcsv($handle, 1000, ",")) !== FALSE)
        {
            if ($parsedProducts == 0)
            {
                $parsedProducts++;
                continue;
            }

            $product = $this->entityManager
                    ->getRepository('FlubitImportExportBundle:Product')
                    ->getExistingOrCreate($line[self::COLUMN_PRODUCT_TITLE], $line[self::COLUMN_IMAGE]);

            $merchant = $this->entityManager
                    ->getRepository('FlubitImportExportBundle:Merchant')
                    ->getExistingOrCreate($line[self::COLUMN_MERCHANT_NAME]);

            $productMerchant = new ProductMerchant;
            $productMerchant->setProduct($product);
            $productMerchant->setMerchant($merchant);
            $productMerchant->setPrice($line[self::COLUMN_PRICE]);

            $this->entityManager->persist($productMerchant);

            $identifiers = $this->entityManager
                    ->getRepository('FlubitImportExportBundle:Identifier')
                    ->getExistingOrCreate($line[self::COLUMN_IDENTIFIERS]);

            foreach ($identifiers as $identifier)
            {
                $productIdentifier = new ProductIdentifier;
                $productIdentifier->setProduct($product);
                $productIdentifier->setIdentifier($identifier['identifier']);
                $productIdentifier->setValue($identifier['value']);

                $this->entityManager->persist($productIdentifier);
            }

            $this->entityManager->flush();

            $parsedProducts++;
        }

        fclose($handle);

        return ($parsedProducts - 1);
    }

}
