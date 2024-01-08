<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TodoFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => false, // Le champ n'est pas obligatoire
                'label' => 'Name',   // Libellé du champ
            ]);
        // Ajoutez d'autres champs au besoin pour votre filtre
    }
}