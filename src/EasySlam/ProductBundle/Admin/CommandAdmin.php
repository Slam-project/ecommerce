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

            ->add('etat', null,
                array(
                    'label' => "État",
                    "required" => true,
                    "multiple" => false,
                    "by_reference" => true,
                )
            )->add('detailsCommands', 'sonata_type_collection', array(
                'type_options' => array(
                    // Prevents the "Delete" option from being displayed
                    'delete' => false,
                    'delete_options' => array(
                        // You may otherwise choose to put the field but hide it
                        'type'         => 'hidden',
                        // In that case, you need to fill in the options as well
                        'type_options' => array(
                            'mapped'   => false,
                            'required' => false,
                        )
                    )
                )
            ), array(
                'edit' => 'inline',
                'inline' => 'table',
                'sortable'  => 'position',
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('etat', null,
                array(
                    'label' => "État",
                    "required" => true,
                    "multiple" => false,
                    "by_reference" => false,
                )
            )
            ->add('final', null,
                array(
                    'label' => "Payé"
                )
            )

        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('etat', null,
                array(
                    'label' => "État",
                    "required" => true,
                    "multiple" => false,
                    "by_reference" => false,
                )
            )
            ->add('final', null,
                array(
                    'label' => "Payé"
                )
            )
        ;
    }
}