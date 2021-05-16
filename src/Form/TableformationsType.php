<?php

namespace App\Form;

use App\Entity\Tablecours;
use App\Entity\Tableformations;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TableformationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Code')
            ->add('Titre')
            ->add('Description')
            ->add('Duree')
            ->add('Type')
            ->add('Prix')
            ->add('Etat')
            ->add('imageFile',FileType::class,[
                'required' => false
            ])


            ->add('cours', EntityType::class,
            [
                'class'=>Tablecours::class,
                'choice_label'=>'Titre',
                'translation_domain' => 'Default',
                'required' => false,
                'multiple' => true,

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tableformations::class,
        ]);
    }
}
