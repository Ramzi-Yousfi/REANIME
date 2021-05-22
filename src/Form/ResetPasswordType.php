<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'les mots de passe doivent etre identique',
                'required' => true,
                'first_options' => [
                    'label' => 'votre nouveau mot de passe',
                    'attr' => [
                        'placeholder' => '******votre nouveau mot de passe******'
                    ],
                ],
                'second_options' => [
                    'label' => 'confirmez votre nouveau mot de passe ',
                    'attr' => [
                        'placeholder' => '******confirmez votre nouveau mot de passe******'
                    ],
                ],
            ])

            ->add('submit', SubmitType::class,[
                'label'=>'Mettre à jour',
                'attr'=>[
                    'class'=>'btn-block btn-info'
                ]
            ])
        ;
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
