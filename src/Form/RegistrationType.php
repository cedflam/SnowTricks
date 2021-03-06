<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class,[
                'label'=> 'Nom'
            ])
            ->add('firstName', TextType::class,[
                'label'=> 'Prénom'
            ])
            ->add('username', TextType::class, [
                'label'=> 'Pseudo'
            ])
            ->add('email', EmailType::class, [
                'label'=>'Email'
            ])
            ->add('hash', PasswordType::class,[
                'label'=> 'Mot de passe'
            ])
            ->add('imgProfile', FileType::class,[
                'label'=> "Image de profile (Type: jpg / png)",
                'required'=> false
              
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
