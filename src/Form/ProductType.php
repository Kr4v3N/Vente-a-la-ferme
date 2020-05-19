<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\ProductCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'attr' => array(
                    'class' => 'text-box',
                    'placeholder' => 'Nom'
                )
            ))
            ->add('description', TextareaType::class, array(
                'attr' => array(
                    'class' => 'text-box',
                    'placeholder' => 'Description'
                )
            ))

            ->add('category', EntityType::class, array(
                'class' => ProductCategory::class,
                'attr' => array(
                    'class' => 'text-box',
                ),
                'placeholder' => "Veuillez choisir une catégorie"
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
