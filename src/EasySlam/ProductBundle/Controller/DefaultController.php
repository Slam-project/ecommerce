<?php

namespace EasySlam\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use EasySlam\ProductBundle\ProductHandler;

class DefaultController extends Controller
{
    /**
     * @Route(path="/nos-produits", name="product")
     * @Template()
     */
    public function indexAction()
    {
        $test = $this->get('product_handler');

        return array();
    }
}
