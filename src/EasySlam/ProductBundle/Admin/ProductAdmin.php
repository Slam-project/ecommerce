<?php

namespace EasySlam\ProductBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\AdminInterface;

class ProductAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Nom'))
            ->add('description', 'text', array('label' => 'Description'))
            ->add('price', 'money', array('label' => 'Prix'))
            ->add('stock', 'text', array('label' => 'Stock'))
            ->add('imageFile', 'file', array('attr' => array(
                'style' => 'padding-bottom:40px;',
            ), 'required' => false))
            ->add('variantesCategory', null, ['label' => "Categorie", "required" => false, "multiple" => true, "by_reference" => false])
            ->add('variantesColor', null, ['label' => "Color", "required" => false, "multiple" => true, "by_reference" => false])
            ->add('variantesType', null, ['label' => "Type", "required" => false, "multiple" => true, "by_reference" => false])
            ->add('isPlanteSemaine', 'checkbox', array(
                'label' => 'Plante de la semaine',
                'required' => false
            ))
            ->add('isPlanteMois', 'checkbox', array(
                'label' => 'Plante du mois',
                'required' => false
            ))
            ->add('isAccessoireSemaine', 'checkbox', array(
                'label' => 'Accessoire de la semaine',
                'required' => false
            ))
            ->add('isAccessoireMois', 'checkbox', array(
                'label' => 'Accessoire du mois',
                'required' => false
            ))
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('stock')
            ->add('isPlanteSemaine')
            ->add('isPlanteMois')
            ->add('isAccessoireSemaine')
            ->add('isAccessoireMois')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description')
            ->add('price')
            ->add('stock')
            ->add('isPlanteSemaine')
            ->add('isPlanteMois')
            ->add('isAccessoireSemaine')
            ->add('isAccessoireMois')
        ;
    }
}