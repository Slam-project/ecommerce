<?php

namespace EasySlam\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route(path="/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
