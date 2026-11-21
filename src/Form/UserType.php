<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Workshops;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use PHPUnit\Framework\Constraint\Count;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;




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
                'attr' => ['placeholder' => '0612345678', 'pattern' => '^(06|\+316)\d{8}$'],
                'required' => false,
                'constraints' => [
                    new Assert\Regex(pattern: '/^(06|\+316)\d{8}$/', message: 'Vul een geldig telefoonnummer in.')
                ]
            ])

            ->add('birthDate', DateTimeType::class, [
                'label' => 'Geboortedatum',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'mapped' => false,
                'constraints' => [
                    new Assert\LessThan('today', message: 'Uw geboortedatum kan niet in de toekomst zijn.'),
                    new Assert\NotBlank(message: 'Het veld mag niet leeg zijn.'),
                ]

            ])
            ->add('parentEmail', EmailType::class, [
                'label' => 'Email ouder',
                'attr' => ['placeholder' => 'ouder@voorbeeld.nl'],
                'required' => false,
                'constraints' => [
                    new Assert\Email(message: 'Vul een geldig email adres in.'),
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
            ->add('workshops', EntityType::class, [
                'class' => Workshops::class,
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.username', 'ASC');
                },
                'constraints' => [
                    new Assert\Count(
                        min: 1,
                        max: 2,
                        minMessage: 'U moet minimaal 1 workshop kiezen.',
                        maxMessage: 'U mag maxinaal 2 workshops kiezen.',
                    )
                ]
            ])

            ->add('comment', TextareaType::class, [
                'label' => 'Opmerkingen',
                'required' => false,
                'attr' => ['placeholder' => 'Opmerkingen'],
                'constraints' => [
                    new Assert\Length(max: 300, maxMessage: 'Uw opmerking mag maximaal 300 tekens bevatten'),
                ]
            ])
            ->add('Inschrijving versturen ->', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
