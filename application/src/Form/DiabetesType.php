<?php

namespace App\Form;

use App\Entity\Diabetes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiabetesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('MeasurementDate')
            ->add('BloodGlucose')
            ->add('MeasurementRangeHour')
            ->add('MeasurementRangeMinute')
            ->add('Note')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Diabetes::class,
        ]);
    }
}
