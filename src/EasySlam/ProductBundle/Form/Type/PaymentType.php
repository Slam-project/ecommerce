<?php

namespace EasySlam\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PaymentType extends AbstractType
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
            ->add('NumCB', 'integer', array(
                'label' => 'Numéro carte banquaire : '
            ))
            ->add('Payer', 'submit');
    }

    public function getName()
    {
        return 'Payment';
    }
}