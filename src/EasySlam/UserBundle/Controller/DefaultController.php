<?php

namespace EasySlam\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/account")
 */
class DefaultController extends Controller
{
    /**
     * @Route(path="/commandes", name="manage_commandes")
     * @Template()
     */
    public function ManageCommandesAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->getUser();

        $cmdRepository = $em->getRepository("EasySlamProductBundle:Commands");
        $cmds = $cmdRepository->findBy(array('user' => $user, 'final' => true), array('id' => 'DESC'));

        return array('commandes' => $cmds);
    }

    /**
     * @Route(path="/commande/{id}", name="manage_one_command")
     * @Template()
     */
    public function ManageOneCommandAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $this->getUser();

        $cmdRepository = $em->getRepository("EasySlamProductBundle:Commands");
        $cmd = $cmdRepository->findOneBy(array('user' => $user, 'id' => $id, 'final' => true));

        return array('command' => $cmd);
    }
}
