<?php

namespace App\Form;
use App\Entity\AccountType;
use App\Entity\Account;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NewAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('accountType', EntityType::class, [
            // looks for choices from this entity
            'class' => AccountType::class,
            'mapped' => false,
            // uses the User.username property as the visible option string
            'choice_label' => 'label',
            'choice_value' => function (?AccountType $entity) {
                return $entity ? $entity->getLabel() : '';
            }
        
        ])
            ->add('amount')
            // ->add('accountType')
            ->add('save', SubmitType::class, ['label' => 'Creer compte'])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Account::class,
        ]);
    }
}
