<?php

namespace EasySlam\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\SecurityContext;

class MenuBuilder
{
    /**
     * @var \Knp\Menu\FactoryInterface
     */
    private $factory;

    /**
     * @var \Symfony\Component\Security\Core\SecurityContext
     */
    private $securityContext;

    /**
     * @param \Knp\Menu\FactoryInterface $factory
     * @param \Symfony\Component\Security\Core\SecurityContext $securityContext
     */
    public function __construct(FactoryInterface $factory, SecurityContext $securityContext)
    {
        $this->factory = $factory;
        $this->securityContext = $securityContext;
    }

    public function createMainMenu()
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Accueil', array('route' => 'homepage'));
        $menu->addChild('Nos produits', array('route' => 'product'));
        $menu->addChild('Mon panier', array('route' => 'panier'));
        if (!$this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $menu->addChild('Inscription', array('route' => 'fos_user_registration_register'));
            $menu->addChild('Connexion', array('route' => 'fos_user_security_login'));
        } else {
            $menu->addChild('Historique des commandes', array('route' => 'manage_commandes'));
            $menu->addChild('Déconnexion', array('route' => 'fos_user_security_logout'));
        }


        return $menu;
    }
}