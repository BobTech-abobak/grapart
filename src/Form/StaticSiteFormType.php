<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaticSiteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (boolval($options['edit'])) {
            $builder
                ->add('content', TextareaType::class, [
                    'attr' => ['class' => 'form-control', 'style' => 'height: 300px'],
                    'label' => 'Zawartość'
                ])
                ->add('name', TextType::class, [
                    'attr' => ['class' => 'form-control'],
                    'label' => 'Nazwa pliku',
                    'disabled' => true
                ]);
        } else {
            $builder->add('name', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Nazwa pliku'
            ]);
        }
        $builder->add('id', HiddenType::class, [])
            ->add('submit', SubmitType::class, [
            'attr' => ['class' => 'btn btn-success btn-block'],
            'label' => 'Zapisz zmiany'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'edit' => false
        ));
    }
}