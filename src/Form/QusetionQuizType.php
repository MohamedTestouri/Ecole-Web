<?php

namespace App\Form;
use App\Entity\Question;
use App\Entity\Quiz;
use App\Entity\QusetionQuiz;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QusetionQuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

          ->add('question',EntityType::class,[
               'class'=>Question::class,
               'choice_label'=>function(Question $question) {
                   return sprintf('la Question / %s  /le nom de quiz  / %s /', $question->getQuestionA(), $question->getType());
               }




            ])
           ->add('quiz',EntityType::class,[
                'class'=>Quiz::class,
               'choice_label'=>'nom_quiz'
            ])
            ->add('captcha', CaptchaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => QusetionQuiz::class,
        ]);
    }
}
