<?php

namespace AppBundle\Form;

use Symfony\Component\Form\{
    AbstractType,
    Extension\Core\Type\EmailType,
    Extension\Core\Type\TextareaType,
    FormBuilderInterface
    };

class contactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Ici est fait le formulaire en PHP
        $builder
            ->add('name')
            ->add('email', EmailType::class)
            ->add('phone')
            ->add('message', TextareaType::class)
        ;
    }

    public function getName()
    {
        return 'appbundle_contacttype_default';
    }
}
