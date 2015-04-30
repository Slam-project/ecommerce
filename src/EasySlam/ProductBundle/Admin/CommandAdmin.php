<?php

namespace EasySlam\ProductBundle\Admin;

use EasySlam\ProductBundle\Entity\DetailsCommand;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\AdminInterface;

class CommandAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id', 'text',
                array(
                    'label' => 'Commande',
                    'attr' => array(
                        'readonly' => true
                    )
                )
            )
            ->add('detailsCommands', 'sonata_type_collection',
                array(
                    'type' => 'entity',
                    'label' => "Produits",
                    'type_options' => array(
                        'class' => 'EasySlamProductBundle:DetailsCommand',
                        'data_class' => null
                    ),
                    'attr' => array(
                        'readonly' => true
                    )
                )
            )
            ->add('etat', null,
                array(
                    'label' => "État",
                    "required" => true,
                    "multiple" => false,
                    "by_reference" => true,
                )
            )
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
        ;
    }
}