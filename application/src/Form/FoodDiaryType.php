<?php

namespace App\Form;

use App\Entity\FoodDiary;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FoodDiaryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('TimeWokeUp')
            ->add('MealTime')
            ->add('MealDescription')
            ->add('WhereWas')
            ->add('WithWhom')
            ->add('HungerLevel')
            ->add('PostMealSatietyLevel')
            ->add('typeOfMeal')
            ->add('SatisfactionWithFood')
            ->add('User')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FoodDiary::class,
        ]);
    }
}
