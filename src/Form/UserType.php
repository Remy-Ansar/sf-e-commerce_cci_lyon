<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Votre prénom:',
                'required' => false,
                'attr' => [
                    'placeholder' => 'John',
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Votre nom:',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Doe',
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email:',
                'required' => false,
                'attr' => [
                    'placeholder' => 'john.doe@email.com:',
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Votre mot de passe',
                'required' => true,
                'mapped' => false,
                'invalid_message' => "Les mots de passe ne correspondent pas",

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'isAdmin' => false,
            'sanitize_html' => true,
        ]);
    }
}
