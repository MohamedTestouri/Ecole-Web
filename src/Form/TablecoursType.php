<?php

namespace App\Form;

use App\Entity\Tablecours;
use App\Entity\Tableformations;
use phpDocumentor\Reflection\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class TablecoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Code')
            ->add('Titre')
            ->add('Duree')
            ->add('Contenu')
            ->add('imageFile', FileType::class,[
                'required' => false
            ])
            ->add('PDFFile', FileType::class,[
                'required' => false
            ])
            ->add('VIDEOFile', FileType::class,[
                'required' => false
            ])


            ->add('formations', EntityType::class,
                [
                    'class'=>Tableformations::class,
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
            'data_class' => Tablecours::class,
        ]);
    }
}
