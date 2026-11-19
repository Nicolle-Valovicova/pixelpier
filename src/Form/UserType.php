<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;





class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['placeholder' => 'noor@voorbeeld.nl'],
                'constraints' => [
                    new Assert\Email(message: 'Vul een geldig email adres in.'),
                    new Assert\NotBlank(message: 'Het veld mag niet leeg zijn.')
                ]
            ])
            ->add('firstName', TextType::class, [
                'label' => 'voornaam',
                'attr' => ['placeholder' => 'Jan'],
                'constraints' => [
                    new Assert\Length(min: 2, max: 50, minMessage: 'Vul een naam in van minimaal 2 tekens'),
                    new Assert\NotBlank(message: 'Het veld mag niet leeg zijn.')
                ]
            ])

            ->add('lastName', TextType::class, [
                'label' => 'achternaam',
                'attr' => ['placeholder' => 'Roos'],
                'constraints' => [
                    new Assert\Length(min: 2, max: 80, minMessage: 'Vul een achternaam in van minimaal 2 tekens'),
                    new Assert\NotBlank(message: 'Het veld mag niet leeg zijn.')
                ]
            ])

            ->add('phoneNumber', TextType::class, [
                'label' => 'telefoonnummer',
                'attr' => ['placeholder' => '0612345678', 'pattern' => '\^06\s?\d{8}$'],
                'required' => false,
                'constraints' => [
                    new Assert\NotBlank(message: 'Het veld mag niet leeg zijn.'),
                    new Assert\Regex(pattern: '/^\06\s?\d{8}$/', message: 'Vul een geldig telefoonnummer in.')
                ]
            ])

            ->add('birthDate', null, [
                'label' => 'Geboortedatum',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'constraints' => [
                    new Assert\LessThan('today', message: 'Uw geboortedatum kan niet in de toekomst zijn.'),
                    new Assert\NotBlank(message: 'Het veld mag niet leeg zijn.'),
                ]

            ])
            ->add('emptyParentEmail', EmailType::class, [
                'label' => 'Email ouder',
                'attr' => ['placeholder' => 'ouder@voorbeeld.nl'],
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new Assert\Email(message: 'Vul een geldig email adres in.'),
                    new Assert\NotBlank(message: 'Het veld mag niet leeg zijn.')
                ]
            ])
            ->add('lunchPackage', ChoiceType::class, [
                'label' => 'Lunchpakket',
                'attr' => ['placeholder' => 'Maak een keuze'],
                'choices' => [
                    'Standaard' => 'standaard',
                    'Vegetarisch' => 'vegetarisch',
                    'Veganistisch' => 'veganistisch',
                    'Halal' => 'halal'
                ]
            ])
            ->add('workshops')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
