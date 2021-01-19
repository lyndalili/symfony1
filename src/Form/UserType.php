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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('plainPassword', RepeatedType::class, [
           "type" =>PasswordType::class ,  
           "invalid_message" => "Les mots de passe ne correspondent pas !" ,
           "options" =>["attr" => ["class" => "password-field"]],
           "required" => false, 
           "first_options" => ["label" => "Mot de passe"],
           "second_options" => ["label" => "confirmation mot de passe"]
             ])
            ->add('email', EmailType::class, [
           "label" => "Mail",     
            ])
           
           
            ->add('firstName', TextType::class, [
                "label" => "Prénom",     
                 ])
            ->add('lastName', TextType::class,[
                "label" => "Nom",     
                 ])
            ->add("Sauvgarder", SubmitType::class,[
                "attr" => ["class" => "btn btn-primary"]
            ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
