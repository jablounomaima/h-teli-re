<?php
    namespace App\Form;

use App\Entity\Invoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options): void
{
$builder
->add('amount', NumberType::class, [
'label' => 'Montant',
'scale' => 2, // Définit le nombre de décimales
'attr' => ['step' => '0.01'], // Permet des valeurs avec des décimales
])
->add('currency', TextType::class, [
'label' => 'Devise',
])
->add('paymentStatus', TextType::class, [
'label' => 'Statut de paiement',
])
->add('CreateDate', DateTimeType::class, [
'widget' => 'single_text',
'label' => 'Date de création',
])
->add('submit', SubmitType::class, [
'label' => 'Sauvegarder',
]);
}

public function configureOptions(OptionsResolver $resolver): void
{
$resolver->setDefaults([
'data_class' => Invoice::class,
]);
}
}
