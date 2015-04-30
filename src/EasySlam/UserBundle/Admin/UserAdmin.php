<?php

namespace EasySlam\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;

class UserAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', 'text', array(
                'label' => 'Nom de compte',
                'required' => false,
                'attr' => array(
                    'readonly' => true,
                )
            ))
            ->add('enabled', 'checkbox', array(
                'label' => 'Activé',
                'required' => false
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username', null, array(
                'label' => 'Nom de compte'
            ))
            ->add('enabled', null, array(
                'label' => 'Activé'
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username', null, array(
                'label' => 'Nom de compte'
            ))
            ->addIdentifier('enabled', null, array(
                'label' => 'Activé'
            ))
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('delete')
        ;

    }
}