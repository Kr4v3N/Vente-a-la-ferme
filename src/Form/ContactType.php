<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class,
                [   'label'  => 'Prénom',
                'attr' => [
                    'class' => 'text-box',
                    'placeholder' => 'prénom'
                ]])
            ->add('lastname', TextType::class,
                [ 'label' => 'Nom',
                'attr' => [
                    'class' => 'text-box',
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('phone', TextType::class,
                [ 'label'=> 'Télephone',
                    'attr' => [
                        'class' => 'text-box',
                        'placeholder' => 'Numéro de télephone'
                    ]
                ])
            ->add('email', EmailType::class,
                [ 'label'=> 'Email',
                'attr' => [
                    'class' => 'text-box',
                    'placeholder' => 'Votre courriel'
                ]
            ])
            ->add('message', TextareaType::class,
                [ 'label'=> 'message',
                    'attr' => [
                        'class' => 'text-box',
                        'placeholder' => 'votre message'
                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
        ]);
    }

}
