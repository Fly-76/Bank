<?php

namespace App\Form;

use App\Entity\Account;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VirementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    
        $accounts = $options['accounts'];
        $choices = [];
        dump($options);
        foreach ($accounts as $account){

            $choices["compte numéro : " .$account->getId()] = $account->getId();
        }
        
        $builder
            ->add('debit', ChoiceType::class, [
                'label' => 'Compte à débiter',
                'choices' => $choices,
            ])
            ->add('amount', TextType::class, [
                'label' => 'Montant',
            ])
            ->add('credit', ChoiceType::class, [
                'label' => 'Compte à créditer',
                'choices' => $choices,
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
            // 'data_class' => Account::class,
        ]);
        $resolver->setRequired('accounts');
    }
}
