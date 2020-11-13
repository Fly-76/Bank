<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\Operation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OperationFixtures extends Fixture
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

        foreach($datas as $i => $operation) {

        $operation[$i] = new Operation();
        $operation[$i]->setOperationType($operation["operation_type"])
                      ->setAmount($operation["amount"])
                      ->setRegistered(new \DateTime())
                      ->setLabel($operation["registered"])
                      ->setAccountId($operation["account_id"]);

        $manager->persist($operation);
        
        }
        $manager->flush();

    }
}
