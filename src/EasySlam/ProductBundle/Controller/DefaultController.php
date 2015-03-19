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
     * Request type : ?color[]=Blanc&type[]=Intérieur
     *
     * @Route(path="/nos-produits/", name="product")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $varianteColor = $request->query->get('color');
        $varianteType = $request->query->get('type');

        if ($varianteColor && $varianteType) {
            $products = $this->get('product_handler')->getProductsByColorType($varianteColor, $varianteType);
        } elseif ($varianteType) {
            $products = $this->get('product_handler')->getProductsByType($varianteType);
        } elseif ($varianteColor) {
            $products = $this->get('product_handler')->getProductsByColor($varianteColor);
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
