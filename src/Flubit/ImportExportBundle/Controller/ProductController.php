<?php

namespace Flubit\ImportExportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller {

    /**
     * pagination
     * 
     * @Route("/products.json", name="flubit_import_export_products")
     * @Method({"GET"})
     */
    public function productsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $results = array();

        $products = $em->getRepository('FlubitImportExportBundle:Product')->findAll();

        foreach ($products as $product)
        {
            /* @var $product \Flubit\ImportExportBundle\Entity\Product */

            $result = array();

            $result['name'] = $product->getTitle();
            $result['identifiers'] = $em->getRepository('FlubitImportExportBundle:ProductIdentifier')->getProductIdentifiers($product->getId());
            $result['merchants'] = $em->getRepository('FlubitImportExportBundle:ProductMerchant')->getProductMerchants($product->getId());
            $result['cheapest_price'] = $em->getRepository('FlubitImportExportBundle:ProductMerchant')->getProductCheapestPrice($product->getId());

            $results[] = $result;
        }

        return new JsonResponse($results);
    }

}
