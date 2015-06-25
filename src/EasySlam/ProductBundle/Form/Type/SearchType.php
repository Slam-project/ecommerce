<?php
namespace EasySlam\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    /**
     * Build form for product Search
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('Couleur', 'entity',
                array(
                    'class' => 'EasySlamProductBundle:VarianteColor',
                    'property' => 'name',
                    'expanded' => true,
                    'multiple' => true
                )
            )->add('Type','entity',
                array(
                    'class' => 'EasySlamProductBundle:VarianteType',
                    'property' => 'name',
                    'expanded' => true,
                    'multiple' => true
                )
            )->add('Categorie','entity',
                array(
                    'class' => 'EasySlamProductBundle:VarianteCategory',
                    'property' => 'name',
                    'expanded' => true,
                    'multiple' => true
                )
            )->add('Rechercher', 'submit');

        $builder->setMethod('GET');
    }

    public function getName()
    {
        return 'ProductSearch';
    }
}