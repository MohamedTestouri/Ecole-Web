<?php

namespace App\Form;


use App\Entity\Publicite;
use App\Entity\Tableformations;
use App\Entity\CategoryPublicity;
use phpDocumentor\Reflection\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PubliciteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')

            ->add('start_date')
            ->add('end_date')
            ->add('description')
            ->add('code_promo')

            ->add('id_formation',EntityType::class,[
                'class' => Tableformations::class,
                'choice_label' => 'Titre',
            ])
            ->add('category',EntityType::class,[
                'class' => CategoryPublicity::class,
                'choice_label' => 'description',
            ])
            ->add('imageFile', VichImageType::class,[
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Publicite::class,
        ]);
    }
}
