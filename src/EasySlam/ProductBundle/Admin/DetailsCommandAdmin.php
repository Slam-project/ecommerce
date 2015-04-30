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
                'required' => false,
                'attr' => array(
                    'readonly' => true,
                )
            ))
            ->add('description' , 'text', array(
                'label' => 'De',
                'required' => false,
                'attr' => array(
                    'readonly' => true
                )
            ))
            ->add('quantite' , 'text', array(
                'label' => 'Quantité',
                'required' => false,
                'attr' => array(
                    'readonly' => true
                )
            ))
            ->add('price' , 'text', array(
                'label' => 'Prix',
                'required' => false,
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