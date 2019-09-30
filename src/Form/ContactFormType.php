<?php
namespace App\Form;

use App\Entity\Mail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('email', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Adres e-mail', 'aria-label' => 'email', 'aria-describedby' => 'email-addon']
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Numer telefonu', 'aria-label' => 'phone', 'aria-describedby' => 'phone-addon']
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'form-control w-100 p-1', 'placeholder' => 'Treść wiadomości']
            ])
            ->add('url', HiddenType::class, ['data' => $options['url']])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-default']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mail::class,
            'url' => null
        ]);
    }
}