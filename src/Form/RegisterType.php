<?php

namespace App\Form;

use App\Entity\ProfilImage;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

use Symfony\UX\Dropzone\Form\DropzoneType;

class RegisterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('firstname', TextType::class, [
                'label' => ' Nom',
                'constraints' => new length([
                    'min'=>2,
                    'max'=>20,
                ]),
                'attr' => [
                    'placeholder' => 'votre nom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => ' Prenom',
                'constraints' => new length([
                    'min'=>2,
                    'max'=>20,
                ]),
                'attr' => [
                    'placeholder' => 'votre prenom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'email',
                'constraints' => new length([
                    'min'=>2,
                    'max'=>50,
                ]),
                'attr' => [
                    'placeholder' => 'exemple@email.com'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'les mots de passe doivent etre identique',
                'required' => true,
                'first_options' => [
                    'label' => 'mot de passe',
                    'attr' => [
                        'placeholder' => '************'
                    ],
                ],
                'second_options' => [
                    'label' => 'confirmez votre mot de passe',
                    'attr' => [
                        'placeholder' => '************'
                    ],
                ],
            ])
            ->add('age',IntegerType::class,[
                'attr'=>[
                    'min'=>'16',
                    'max'=>'80'
                ]
            ])

            ->add('avatar', DropzoneType::class, [
                'attr' => [
                    'data-controller' => 'mydropzone',
                    'placeholder' => 'glisser votre image ici ou
                    cliquez ici pour la telecharger '
                    ],
                'label'=> 'choisir une photo de profil',
                 'required' => false,

        ])




            ->add('envoyer', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
