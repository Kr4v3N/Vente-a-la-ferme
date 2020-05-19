<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PasswordUpdateType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class,
                $this->getConfiguration(
                    "Mot de passe", "Entrer votre mot de passe actuel"
                ))
            ->add('newPassword', PasswordType::class,
                $this->getConfiguration(
                    "Nouveau mot de passe", "Entrer votrer nouveau mot de passe"
                ))
            ->add('confirmPassword', PasswordType::class,
                $this->getConfiguration(
                    "Confirmation du mot de passe", "Veuillez confirmer votre nouveau mot de passe"
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
