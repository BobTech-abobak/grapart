<?php
namespace App\Form;

use App\Entity\Mail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('email')
            ->add('phone')
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'w-100 p-1', 'placeholder' => 'Treść wiadomości']
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-default']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mail::class
        ]);
    }
}