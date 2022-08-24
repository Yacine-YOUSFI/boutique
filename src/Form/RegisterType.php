<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'required'   => false,
                'attr' => [
                    'placeholder' => 'firstname'
                ]
            ])
            ->add('lastname',  TextType::class, [
                'required'   => false,
                'attr' => [
                    'placeholder' => 'lastname'
                ]
            ])
            ->add('email', EmailType::class, [
                'required'   => false,
                'attr' => [
                    'placeholder' => 'email'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type'   => PasswordType::class,
                'invalid_message' => 'mot de passe non compatible',
                'required' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => "s'inscrire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
