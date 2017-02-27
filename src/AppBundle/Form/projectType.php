<?php

namespace AppBundle\Form;

use Symfony\Component\Form\{
    AbstractType, Extension\Core\Type\ChoiceType, Extension\Core\Type\TextareaType, FormBuilderInterface
};

class projectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Ici est fait le formulaire en PHP
        $builder
            ->add('nom')
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Site demo' => 'Site demo',
                    'Site client' => 'Site client',
                ]
            ])
            ->add('description')
            ->add('website')
            ->add('content', TextareaType::class)
        ;
    }

    public function getName()
    {
        return 'appbundle_projecttype_default';
    }
}
