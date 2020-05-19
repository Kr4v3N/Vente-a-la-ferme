<?php

namespace App\Form;


use App\Entity\Consumer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ConsumerType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('User', UserType::class, [
                'label' => false,
            ])
            ->add('userName', TextType::class, $this->getConfiguration("pseudo", "Votre pseudo..."))
            ->add('address', TextType::class, $this->getConfiguration("adresse", "Ici votre adresse..."))
            ->add('postalCode', TextType::class, $this->getConfiguration("code postal", "Votre code postal ici..."))
            ->add('city', TextType::class, $this->getConfiguration("ville", "votre ville..."))

        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consumer::class,
        ]);
    }
}