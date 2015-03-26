<?php

namespace EasySlam\ProductBundle\Controller;

use EasySlam\ProductBundle\SearchForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use EasySlam\ProductBundle\ProductHandler;
use Symfony\Component\HttpFoundation\Request;
use EasySlam\ProductBundle\Form\Type\SearchType;

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
        $varianteColor = null;
        $varianteType = null;

        $productSearch = $request->query->all();
        if (isset($productSearch['ProductSearch'])) {
            $productSearch = $productSearch['ProductSearch'];
        }

        if (isset($productSearch)) {
            if (isset($productSearch['Couleur'])) {
                $varianteColor = $productSearch['Couleur'];
            }

            if (isset($productSearch['Type'])) {
                $varianteType = $productSearch['Type'];
            }
        }

        if ($varianteColor && $varianteType) {
            $products = $this->get('product_handler')->getProductsByColorType($varianteColor, $varianteType);
        } elseif ($varianteType) {
            $products = $this->get('product_handler')->getProductsByType($varianteType);
        } elseif ($varianteColor) {
            $products = $this->get('product_handler')->getProductsByColor($varianteColor);
        } else {
            $products = $this->get('product_handler')->getAllProducts();
        }

        $form = $this->createForm(new SearchType());

        return array("products" => $products, 'formSearch' => $form->createView());
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
