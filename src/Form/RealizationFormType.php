<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RealizationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!boolval($options['edit'])) {
            $builder
                ->add('image', FileType::class, [
                    'attr' => ['class' => 'form-control-file'],
                    'label' => 'Obrazek'
                ]);
        }
        $builder->add('title', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Tytuł'
            ])
            ->add('id', HiddenType::class, [])
            ->add('categories', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Kategorie',
                'choices'  => $options['categories'],
                'multiple' => true,
                'expanded' => true
            ])
            ->add('order', IntegerType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Kolejność'
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success btn-block'],
                'label' => 'Zapisz zmiany'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'categories' => array(),
            'edit' => false
        ));
    }
}