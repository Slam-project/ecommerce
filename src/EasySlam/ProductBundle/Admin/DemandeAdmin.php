<?php

namespace EasySlam\ProductBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;

class DemandeAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            /*->add('id', null,
                array(
                    'label' => 'Numéro de demande',
                    'attr' => array(
                        'readonly' => true
                    ),
                    "required" => false
                )
            )*/
            ->add('product', null,
                array(
                    'label' => 'Produit',
                    'required' => true,
                    'multiple' => false,
                    'by_reference' => true
                )
            )
            ->add('quantite', null,
                array(
                    'label' => "Quantite",
                    "required" => true
                )
            )
            ->add('date', null,
            array(
                'label' => "Date limite",
                'required' => true
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('product', null,
                array(
                    'label' => 'Produit'
                )
            )
            ->add('quantite', null,
                array(
                    'label' => "Quantité"
                )
            )

        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('product', null,
                array(
                    'label' => "Produit",
                )
            )
            ->add('quantite', null,
                array(
                    'label' => "Quantité"
                )
            )
        ;
    }
}