<?php

namespace EasySlam\ProductBundle\Controller;

use EasySlam\ProductBundle\Handler\ProductHandler;
use EasySlam\ProductBundle\Handler\PanierHandler;
use EasySlam\ProductBundle\Form\Type\BuyProductType;
use EasySlam\ProductBundle\Form\Type\SearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Route(path="/produit/{id}", requirements={"id" = "\d+"}, name="productInfo")
     * @Template()
     */
    public function productAction(Request $request, $id)
    {
        $form = $this->createForm(new BuyProductType());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->get('panier_handler')->addProduct($id, $request);
        }

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('EasySlamProductBundle:Product');
        $produit = $product->find($id);

        return array('product' => $produit, 'panier' => $form->createView());
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
