<?php

namespace App\Form;

use App\Entity\CatEvent;
use App\Entity\Evenement;
use App\Entity\Participate;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('users',EntityType::class,[
                'class'=>Users::class,
                'choice_label'=>'email'
            ])
            ->add('events',EntityType::class,[
                'class'=>Evenement::class,
                'choice_label'=>'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participate::class,
        ]);
    }
}
