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
        $em = $this->getDoctrine()->getEntityManager();

        $productRepository = $em->getRepository("EasySlamProductBundle:Product");

        $planteSemaine = $productRepository->findOneBy(array("isPlanteSemaine" => true));
        $planteMois = $productRepository->findOneBy(array("isPlanteMois" => true));
        $accessoireSemaine = $productRepository->findOneBy(array("isAccessoireSemaine" => true));
        $accessoireMois = $productRepository->findOneBy(array("isAccessoireMois" => true));

        return array(
            "planteSemaine" => $planteSemaine,
            "planteMois" => $planteMois,
            "accessoireSemaine" => $accessoireSemaine,
            "accessoireMois" => $accessoireMois
        );
    }
}
