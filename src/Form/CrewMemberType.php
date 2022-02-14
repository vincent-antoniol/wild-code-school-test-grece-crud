<?php

namespace App\Form;

use App\Entity\CrewMember;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CrewMemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TypeTextType::class, [
                'label' => 'Quel est le nom du nouveau membre de l\'équipage ?',
                'attr' => [
                    'placeholder' => 'Entrez le nom du nouveau membre de l\'équipage'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Ajouter à l'équipage"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CrewMember::class,
        ]);
    }
}
