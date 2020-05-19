<?php

namespace App\Form;

use App\Entity\Homepage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HomepageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('backgroundImage', FileType::class, [
                'data_class' => null,
                'required' => false,
            ])
            ->add('MainTitle')
            ->add('consummerTitle')
            ->add('consummerText')
            ->add('consummerImage', FileType::class, [
                'data_class' => null,
                'required' => false,
            ])
            ->add('farmerTitle')
            ->add('farmerImage', FileType::class, [
                'data_class' => null,
                'required' => false,
            ])
            ->add('farmerText')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Homepage::class,
        ]);
    }
}
