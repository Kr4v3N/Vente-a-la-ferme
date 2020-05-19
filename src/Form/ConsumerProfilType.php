<?php

namespace App\Form;

use App\Entity\Consumer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsumerProfilType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('User', UserProfilType::class)
            ->add('userName', TextType::class, $this->getConfiguration("pseudo", "Votre pseudo..."))
            ->add('address', TextType::class, $this->getConfiguration("adresse", "Ici votre adresse..."))
            ->add('postalCode', TextType::class, $this->getConfiguration("code postal", "Votre code postal ici..."))
            ->add('city', TextType::class, $this->getConfiguration("ville", "votre ville..."))
            ->add('description', TextareaType::class, [
                    'required' => false,
                ], $this->getConfiguration("description", "Votre description..."))
            ->add('profilPicture', FileType::class, [
                    'data_class' => null,
                    'required' => false,
                ])
            //->add('farmers')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consumer::class,
        ]);
    }
}
