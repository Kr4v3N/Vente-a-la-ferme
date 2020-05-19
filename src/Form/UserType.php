<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Farmer;
use App\Entity\Consumer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;

class UserType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration("Prénom", "Votre prénom..."))
            ->add('lastName', TextType::class, $this->getConfiguration("Nom", "Votre nom..."))
            ->add('email', EmailType::class, $this->getConfiguration("Email", "camilo@gmail.com"))
            ->add('password', PasswordType::class, $this->getConfiguration("Mot de passe", "Choisissez un bon mot de passe"))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Confirmation mot de passe", "Veuillez confirmer votre mot de passe"))
//            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
//                $password =$event->getData()->getPassword();
//                $form = $event->getForm();
//                $form->add('password', TextType::class, array(
//                    'data_class' => null,
//                    'attr' => array(
//                        'class'=> "",
//                    ),
//                    'required' => false,
//                    'constraints' => empty($password) ?
//                        [new Assert\NotBlank()] :
//                        []
//                ));

//            })

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
