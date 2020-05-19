<?php

namespace App\Form;

use App\Entity\Farmer;
use Faker\Provider\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\CallbackTransformer;


class FarmerProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('User', UserProfilType::class)

            ->add('address', TextType::class,
                [   'label'  => 'Adresse',
                    'attr' => [
                    'class' => 'text-box',
                    'placeholder' => 'Renseigner une adresse parmi les choix afin d\'être géolocalisé',
                    ]]
            )
            ->add('postalCode', TextType::class,
                [    'label'  => 'Code postal',
                    'attr' => [
                    'class' => 'text-box',
                ]]
            )
            ->add('city', TextType::class,
                [    'label'  => 'Ville',
                    'attr' => [
                    'class' => 'text-box',
                ]]
            )
            ->add('farmName', TextType::class,
                [    'label'  => 'Nom de la ferme',
                    'attr' => [
                    'class' => 'text-box',
                ]]
            )
            ->add('farmDescription', TextareaType::class,
                [   'label'  => 'Description de la ferme',
                    'attr' => [
                    'class' => 'text-box',
                ]]
            )
            ->add('phone', TextType::class,
                [   'label'  => 'Téléphone',
                    'attr' => [
                    'class' => 'text-box',
                ]]
            )
            ->add('schedule', TextareaType::class,
                [   'label'  => 'Vos horaires d\'ouverture',
                    'attr' => [
                        'class' => 'text-box',
                        'required' => false,
                        'placeholder' => 'Exemple : Lundi 8h-18h, Mardi 16h-19h, Jeudi 16h-18h, Samedi 8h-18h'
                    ]]
            )

            ->add('photoProfil', FileType::class,
                [   'data_class' => null,
                    'required' => false,
                        'label' => 'Insérez votre photo',
                    ]
                )

            ->add('photoFarm', FileType::class,
                ['data_class' => null,
                    'required' => false,
                    'label' => 'Insérez une image de votre ferme',
                   ]
            )
            ->add('lat', HiddenType::class)

            ->add('lng', HiddenType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Farmer::class,
        ]);
    }
}
