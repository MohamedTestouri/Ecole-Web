<?php

namespace App\Form;

use App\Entity\Tableformations;
use App\Entity\Tag;
use App\Entity\Tablecours;
use App\Entity\TagCours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagCoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('tag',EntityType::class,[
                'class' => Tag::class,
                'choice_label' => 'tag_name',
            ])
            ->add('formation',EntityType::class,[
                'class' => Tableformations::class,
                'choice_label' => 'Titre',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TagCours::class,
        ]);
    }
}
