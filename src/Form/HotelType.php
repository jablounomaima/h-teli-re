<?php

namespace App\Form;

use App\Entity\Hotel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Hotel Name',
                'required' => true,
            ])
            ->add('location', TextType::class, [
                'label' => 'Location',
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => true,
            ])
            ->add('contactInfo', TextType::class, [
                'label' => 'Contact Info',
                'required' => true,
            ])
            ->add('imagePath', FileType::class, [
                'label' => 'Hotel Image (optional)',
                'mapped' => false, // This ensures the field won't be mapped to the entity
                'required' => false,
            ])
            ->add('chaine', EntityType::class, [
                'class' => \App\Entity\Chaine::class,
                'choice_label' => 'name', // Assuming the Chaine entity has a "name" field
                'label' => 'Chaine',
                'placeholder' => 'Select a chaine',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Save',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
        ]);
    }
}

