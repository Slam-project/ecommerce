<?php

namespace EasySlam\ProductBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;

class DetailsCommandAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array(
                'label' => 'Nom',
                'attr' => array(
                    'readonly' => true
                )
            ))
            ->add('description' , 'text', array(
                'label' => 'De',
                'attr' => array(
                    'readonly' => true
                )
            ))
            ->add('quantite' , 'text', array(
                'label' => 'Quantité',
                'attr' => array(
                    'readonly' => true
                )
            ))
            ->add('price' , 'text', array(
                'label' => 'Prix',
                'attr' => array(
                    'readonly' => true
                )
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('delete')
            ->remove('edit')
        ;

    }
}