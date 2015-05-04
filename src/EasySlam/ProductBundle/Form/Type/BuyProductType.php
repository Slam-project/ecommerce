<?php

namespace EasySlam\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BuyProductType extends AbstractType
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
            ->add('Quantite', 'integer', array(
                'label' => 'Quantité'
            ))
            ->add('Ajouter au panier', 'submit');
    }

    public function getName()
    {
        return 'BuyProduct';
    }
}