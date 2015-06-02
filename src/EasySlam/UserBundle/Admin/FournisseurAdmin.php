<?php

namespace EasySlam\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;

class FournisseurAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('login', 'text', array(
                'label' => 'Nom de compte',
                'required' => true
            ))
            ->add('password', 'text', array(
                'label' => 'Mot de passe',
                'required' => true
            ))
            ->add('email', 'text', array(
                'label' => 'Adresse Email',
                'required' => true
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('login', null, array(
                'label' => 'Nom de compte'
            ))
            ->add('password', null, array(
                'label' => 'Mot de passe'
            ))
            ->add('email', null, array(
                'label' => 'Adresse Email'
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('login', null, array(
                'label' => 'Nom de compte'
            ))
            ->addIdentifier('password', null, array(
                'label' => 'Mot de passe'
            ))
            ->addIdentifier('email', null, array(
                'label' => 'Adresse Email'
            ))
        ;
    }


}