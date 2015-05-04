<?php

namespace EasySlam\ProductBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\AdminInterface;

class EtatCommandAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('etat', 'text', array('label' => 'Nom de l\'état'))
            ->add('color' , 'text', array('label' => 'Couleur (en héxa)'))
            ->add('base', 'checkbox',
                array(
                    'label' => 'État par défaut',
                    'required' => false
                )
            )
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('etat')
            ->add('color')
            ->add('base', null, array(
                'label' => 'État par défaut'
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('etat')
            ->addIdentifier('color')
            ->addIdentifier('base', null, array(
                'label' => 'État par défaut'
            ))
        ;
    }
}