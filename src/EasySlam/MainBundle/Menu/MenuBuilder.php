<?php

namespace EasySlam\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    /**
     * @var \Knp\Menu\FactoryInterface
     */
    private $factory;

    /**
     * @param \Knp\Menu\FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu()
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Accueil', array('route' => 'homepage'));
        $menu->addChild('Nos produits', array('route' => 'homepage'));
        $menu->addChild('Non panier', array('route' => 'homepage'));
        $menu->addChild('Inscription', array('route' => 'homepage'));
        $menu->addChild('Connexion', array('route' => 'homepage'));

        return $menu;
    }
}