<?php

namespace App\Form;

use App\Entity\ProductFarmer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductFarmerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //if (ID USER CONNECTE == ID DE CELUI QUI A CREE LE PRODUIT)
        $builder
            ->add('product', ProductType::class)

        // ELSE
        //  ->add('product')

            ->add('price', TextType::class, array(
                'attr' => array(
                    'class' => 'text-box',
                    'placeholder' => 'Prix'
                )
            ))

            ->add('weight', TextType::class, array(
                'attr' => array(
                    'class' => 'text-box',
                    'placeholder' => 'Poids'
                )
            ))

            ->add('kiloPrice', TextType::class, array(
                'attr' => array(
                    'class' => 'text-box',
                    'placeholder' => 'Prix kilo'
                )
            ))

           ->add('image', FileType::class, array(
                'label' => 'Image',
               'data_class' => null,
                'required' => false,
                'attr' => array(
                    'class' => 'text-white',
                )
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductFarmer::class,
        ]);
    }
}
