<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Salle;
use App\Entity\Seance;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\DataTransformerChain;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateSeance', DateTimeType::class, [
                'widget' => 'single_text',
                'html5' => false,
            ])
            ->add('film', EntityType::class, [
                'class' => Film::class,
                'choice_label' => 'titre',
            ])
            ->add('salle', EntityType::class, [
                'class' => Salle::class,
                'choice_label' => 'nom',
            ])
        ;
        // $builder->get('dateSeance')->addModelTransformer(
        //     new CallbackTransformer(
        //         function ($dateString) {
        //             // transform the string back to an Datetime
        //             if($dateString) {
        //                 return new DateTime($dateString);
        //             }
        //         },
        //         function ($date) {
        //             // transform the dateTime to a string
        //             if($date) {
        //                 return $date->format('Y-m-d H:i');
        //             }
        //         }
        //     )
        // );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Seance::class,
        ]);
    }
}
