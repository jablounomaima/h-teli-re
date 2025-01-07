<?php

namespace App\Form;

use App\Entity\Invoice;
use App\Entity\Reservation;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('checkInDate', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('checkOutDate', DateTimeType::class, [
                'widget' => 'single_text',
            ])

            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'name', // Symfony utilisera la méthode __toString() pour convertir l'objet en chaîne
            ])

            ->add('satuts', TextType::class)

            ->add('invoice', EntityType::class, [
                'class' => Invoice::class,
                'choice_label' => 'id', // Utilisera la méthode __toString() pour afficher l'ID de la facture
            ]);





    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
