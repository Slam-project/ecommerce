<?php

namespace EasySlam\ProductBundle\Controller;

use EasySlam\ProductBundle\Form\Type\PaymentType;
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
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param int page
     *
     * @Route(path="/nos-produits/", name="product")
     * @Route(path="/nos-produits/{page}", defaults={"page"="1"}, requirements={"page" = "\d+"}, name="product_with_page")
     * @Template()
     *
     * @return array
     */
    public function indexAction(Request $request, $page = 1)
    {
        $productSearch = $request->query->all();
        if (isset($productSearch['ProductSearch'])) {
            $productSearch = $productSearch['ProductSearch'];
        }

        if (isset($productSearch)) {
            if (isset($productSearch['Couleur']) && isset($productSearch['Type']) && isset($productSearch['Categorie'])){
                $products = $this->get('product_handler')
                    ->getProductsByColorTypeCategory($page, $productSearch['Couleur'], $productSearch['Type'], $productSearch['Categorie']);
            } elseif (isset($productSearch['Couleur']) && isset($productSearch['Type'])) {
                $products = $this->get('product_handler')
                    ->getProductsByColorType($page, $productSearch['Couleur'], $productSearch['Type']);
            } elseif (isset($productSearch['Couleur']) && isset($productSearch['Categorie'])) {
                $products = $this->get('product_handler')
                    ->getProductsByColorCategory($page, $productSearch['Couleur'], $productSearch['Categorie']);
            } elseif (isset($productSearch['Type']) && isset($productSearch['Categorie'])) {
                $products = $this->get('product_handler')
                    ->getProductsByTypeCategory($page, $productSearch['Type'], $productSearch['Categorie']);
            } elseif (isset($productSearch['Type'])) {
                $products = $this->get('product_handler')->getProductsByType($page, $productSearch['Type']);
            } elseif (isset($productSearch['Couleur'])) {
                $products = $this->get('product_handler')->getProductsByColor($page, $productSearch['Couleur']);
            } elseif (isset($productSearch['Categorie'])) {
                $products = $this->get('product_handler')->getProductsByCategory($page, $productSearch['Categorie']);
            } else {
                $products = $this->get('product_handler')->getAllProducts($page);
            }
        }

        if (empty($products)) {
            return $this->redirect($this->generateUrl('product'));
        }

        $form = $this->createForm(new SearchType());
        $form->handleRequest($request);

        return array("products" => $products, 'formSearch' => $form->createView(), 'page' => $page, 'search' => $request->getQueryString());
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param int $id
     *
     * @Route(path="/produit/{id}", requirements={"id" = "\d+"}, name="productInfo")
     * @Template()
     *
     * @return array
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
        $user = $this->getUser();

        $cmd = $this->getDoctrine()->getRepository("EasySlamProductBundle:Commands")
            ->findBy(array('user' => $user, 'final' => false), array('id' => 'DESC'), 1);

        if ($cmd == null) {
            return array();
        }

        $detailsCommands = $this->getDoctrine()->getRepository("EasySlamProductBundle:DetailsCommand")
            ->findBy(array('command' => $cmd));

        return array('command' => $cmd[0], 'detailsCommands' => $detailsCommands);
    }

    /**
     * Permet de supprimer un item du panier
     *
     * @Route(path="/panier/remove/{id}", name="removeItemFromPanier", requirements={"id" = "\d+"})
     */
    public function panierRemoveAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $detailsCmdRepository = $em->getRepository("EasySlamProductBundle:DetailsCommand");
        $detailsCmd = $detailsCmdRepository->findOneBy(array('id' => $id));

        $user = $this->getUser();
        $cmdRepository = $em->getRepository("EasySlamProductBundle:Commands");
        $cmd = $cmdRepository->findBy(array('user' => $user), array('id' => 'DESC'), 1);

        if ($cmd[0]->getId() === $detailsCmd->getCommand()->getId()) {
            $product = $detailsCmd->getProduct();
            $product->setStock($product->getStock() + $detailsCmd->getQuantite());
            $em->remove($detailsCmd);
            $em->flush();
        }


        return $this->redirect($this->generateUrl('panier'));
    }

    /**
     * @Route(path="/panier/payment", name="payment")
     * @Template()
     */
    public function paymentAction(Request $request)
    {
        $form = $this->createForm(new PaymentType());
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->getUser();

        $cmd = $em->getRepository("EasySlamProductBundle:Commands")
            ->findBy(array('user' => $user, 'final' => false), array('id' => 'DESC'), 1);

        if ($cmd == null) {
            return $this->redirect($this->generateUrl('panier'));
        }

        $prixHt = $checkCommand = $this->get('payment_handler')->getPrixHt($cmd);

        $paymentForm = $request->get('Payment');

        if ($paymentForm != null) {
            $checkCommand = $this->get('payment_handler')->finalCommand($cmd[0], $paymentForm);

            if ($checkCommand) {
                return $this->redirect($this->generateUrl('manage_commandes'));
            }
        }

        $form->handleRequest($request);

        return array('command' => $cmd[0], 'prixHt' => $prixHt, 'form' => $form->createView());
    }
}
