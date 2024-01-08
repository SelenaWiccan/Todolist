<?php

namespace App\Form;

use App\Entity\Todo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('done', null, [
                'label' => 'Fait'
            ])
            ->add('stillTodo', CheckboxType::class,[
                'label' => 'Afficher uniquement les tâches qui restent à faire',
                'mapped' => false,
                'required' => false,
            ])
            //->add('done')
//            ->add('done', CheckboxType::class, [
//                'label' => 'Done',
//                'required' => false,
//                'mapped' => false,
//                'attr' => ['class' => 'form-control'],
//                'value' => 0,
           // ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Todo::class,
        ]);
    }
}
