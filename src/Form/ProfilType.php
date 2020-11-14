<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('civility')
            // ->add('lastname')
            // ->add('firstname')
            ->add('adress', null,['label' => 'Adresse'])
            ->add('zip_code', null ,['label' => 'Code Postal'])
            ->add('city', null ,['label' => 'Ville'])
            // ->add('birth_date')
            // ->add('create_date')
            ->add('email')
            // ->add('roles')
            // ->add('password')
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                "class" => "btn btn-danger"
                ]
              ])
  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
