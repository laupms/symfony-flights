<?php

namespace App\Form;

use App\Entity\Cities;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CitiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Entrez un nom de ville :',
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new Length([
                       'min' => 3,
                       'max' => 100,
                       'minMessage' => 'Le nom de la ville doit avoir 3 caractères au minimum.',
                       'maxMessage' => 'Le nom de la ville doit avoir 100 caractères au maximum.',
                    ]),
                    new NotBlank(),
                    ]

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cities::class,
        ]);
    }
}
