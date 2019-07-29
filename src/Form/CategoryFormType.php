<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Nazwa'
        ])
            ->add('id', HiddenType::class, [])
            ->add('url', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Adres URL'
            ])
            ->add('template', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Szablon pliku',
                'choices' => $options['templates'],
                'required'   => false,
            ])
            ->add('order', IntegerType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Kolejność'
            ])
            ->add('parent', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Kategoria nadrzędna',
                'choices' => $options['categories'],
                'required'   => false,
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success btn-block'],
                'label' => 'Zapisz zmiany'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'templates' => array(),
            'categories' => array(),
        ));
    }
}