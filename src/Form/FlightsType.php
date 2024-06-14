<?php

namespace App\Form;

use App\Entity\Flights;
use App\Entity\Cities;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\String\ByteString;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

//Constraints
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\NotIdenticalTo;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Positive;


class FlightsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('num', TextType::class, [
                 'attr' => [
                    'value' => ByteString::fromRandom(2, 'ABCDEFGIJKLMNOPQRSTUVWXYZ') . ByteString::fromRandom(4, '0123456789'),
                    'readonly' => 'true',
                    'class' => 'form-control',
                ],
                 'label' => 'Numéro de vol',
                 'required' => 'false',
                 
            ])

            ->add('departure', DateTimeType::class, [
                'label' => 'Départ',
                'date_format' => 'd / M / y',
                'attr' => [
                    'class' => 'form-control',
                ],
                'data' => new \DateTime(),
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' =>'Le date doit être celle d\'aujourd\'hui ou supérieure à aujourd\'hui.',
                    ]),
                    new NotBlank(),
                ],
                'years' => [
                    '0' => '2024',
                    '1' => '2025',
                ],
                
                ])

            ->add('city_departure', EntityType::class, [
                'class' => Cities::class,
                'label' => 'Ville de départ',
                'attr' => [
                    'class' => 'form-control',
                ],
                'placeholder' => 'Choisir une ville de départ',
                'choice_label' => 'name',
                'constraints' => [
                    new NotBlank(),
                    new NotIdenticalTo([
                        'value' => 'city_arrival',
                        'message' => 'La ville de départ doit être différente de la ville d\'arrivée',
                    ]),
                    ]
                ])

            ->add('arrival', DateTimeType::class, [
                'label' => 'Arrivée',
                'attr' => [
                    'class' => 'form-control',
                ],
                'date_format' => 'd / M / y',
                'data' => new \DateTime(),
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'Le date doit être supérieure à la date de départ.',
                    ]),
                    new NotBlank(),
                ],
                'years' => [
                    '0' => '2024',
                    '1' => '2025',
                ],
                ])

            ->add('city_arrival', EntityType::class, [
                'class' => Cities::class,
                'label' => 'Ville d\'arrivée',
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_label' => 'name',
                'placeholder' => 'Choisir une ville d\'arrivée',
                'constraints' => [
                    new NotBlank(),
                    new NotIdenticalTo([
                        'value' => 'city_departure',
                        'message' => 'La ville d\'arrivée doit être différente de la ville de départ',
                    ]),
                    ]
                ])

            ->add('price', IntegerType::class, [
                'label' => 'Prix (en €)',
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new Positive([
                        'message' => 'Le prix ne peut être négatif.',
                    ]),
                    new NotBlank(),
                    new Type([
                        'type' => 'integer',
                        'message' => 'Le prix doit être obligatoirement un nombre.',
                    ])
                    ]
                ])

            ->add('discount', CheckboxType::class, [
                'label' => 'Réduction',
                'required' => false,
                ])

            ->add('nb_seat', IntegerType::class, [
                'label' => 'Nombre de places',
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new Positive([
                        'message' => 'Le nombre de places ne peut être négatif.',
                    ]),
                    new NotBlank(),
                    new Type([
                        'type' => 'integer',
                        'message' => 'Le nombre de places doit être obligatoirement un nombre.',
                    ])
                    ]
                ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Flights::class,
        ]);
    }
}
