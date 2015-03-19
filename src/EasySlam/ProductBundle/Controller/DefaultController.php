<?php

namespace EasySlam\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use EasySlam\ProductBundle\ProductHandler;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Request type : ?color[]=Blanc
     *
     * @Route(path="/nos-produits/", name="product")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $varianteColor = $request->query->get('color');

        if ($varianteColor) {
            $products = $this->get('product_handler')->getAllProductsSearch($varianteColor);
        } else {
            $products = $this->get('product_handler')->getAllProducts();
        }

        return array("products" => $products);
    }

    /**
     * Ceci est le controleur du panier
     *
     * @Route(path="/panier", name="panier")
     * @Template()
     */
    public function panierAction()
    {
        return array();
    }

}
