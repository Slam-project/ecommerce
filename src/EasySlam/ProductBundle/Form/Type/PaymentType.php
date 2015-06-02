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
            ->add('addressLiv', 'text', array(
                'label' => 'Adresse de livraison : ',
                'required' => true
            ))
            ->add('cityLiv', 'text', array(
                'label' => 'Ville de livraison : ',
                'required' => true
            ))
            ->add('codePostalLiv', 'text', array(
                'label' => 'Code postal de livraison : ',
                'required' => true
            ))
            ->add('stateLiv', 'text', array(
                'label' => 'Pays de livraison : ',
                'required' => true
            ))
            ->add('dateLiv', 'date', array(
                'label' => 'Date de livraison : ',
                'input' => 'datetime',
                'widget' => 'choice',
                'required' => true,
                'data' => new \DateTime('today')
            ))
            ->add('addressFac', 'text', array(
                'label' => 'Adresse de facturation : ',
                'required' => true
            ))
            ->add('cityFac', 'text', array(
                'label' => 'Ville de facturation : ',
                'required' => true
            ))
            ->add('codePostalFac', 'text', array(
                'label' => 'Code postal de facturation : ',
                'required' => true
            ))
            ->add('stateFac', 'text', array(
                'label' => 'Pays de facturation : ',
                'required' => true
            ))
            ->add('NumCB', 'text', array(
                'label' => 'Numéro carte banquaire : ',
                'required' => true
            ))
            ->add('Payer', 'submit');
    }

    public function getName()
    {
        return 'Payment';
    }
}