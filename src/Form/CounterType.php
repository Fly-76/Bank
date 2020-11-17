<?php

namespace App\Form;

use App\Entity\Account;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CounterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $accounts = $options['accounts'];
        $choices = [];
        
        foreach ($accounts as $account){

            $choices["compte numéro : " .$account->getNumber()] = $account->getNumber();
        }
        
        $builder
            ->add('debit', ChoiceType::class, [
                'label' => 'Compte :',
                'choices' => $choices,
            ])
            ->add('amount', TextType::class, [
                'label' => 'Montant',
            ])
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
            // Configure your form options here
            'data_class' => Account::class,
        ]);
    }
}
