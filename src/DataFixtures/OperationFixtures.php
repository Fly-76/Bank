<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\Operation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\AccountFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class OperationFixtures extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager)
    {
        $datas = array(
            array(
                "operation_type" => "débit",
                "amount" => -300,
                "registered" => "",
                "label" => "carrefour",
                "account_id" => "1"
            ),
            array(
                "operation_type" => "débit",
                "amount" => -200,
                "registered" => "",
                "label" => "auchan",
                "account_id" => "2"
            ),
            array(
                "operation_type" => "débit",
                "amount" => -400,
                "registered" => "",
                "label" => "fnac",
                "account_id" => "2"
            ),
            array(
                "operation_type" => "débit",
                "amount" => -100,
                "registered" => "",
                "label" => "decathlon",
                "account_id" => "1"
            ),
            array(
                "operation_type" => "débit",
                "amount" => -50,
                "registered" => "",
                "label" => "burger king",
                "account_id" => "2"
            ),
            array(
                "operation_type" => "débit",
                "amount" => -10,
                "registered" => "",
                "label" => "carrefour",
                "account_id" => "1"
            ),
            array(
                "operation_type" => "débit",
                "amount" => -250,
                "registered" => "",
                "label" => "leroy merlin",
                "account_id" => "2"
            )
        );
        $account = $this->getReference(AccountFixtures::ADMIN_ACCOUNT_REFERENCE);
        foreach($datas as $operations) {

        $operation = new Operation();
        $operation ->setOperationType($operations["operation_type"])
                    ->setAmount($operations["amount"])
                    ->setRegistered(new \DateTime())
                    ->setLabel($operations["registered"])
                    ->setAccountId($account);

        $manager->persist($operation);
        
        }
        $manager->flush();

    }
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
