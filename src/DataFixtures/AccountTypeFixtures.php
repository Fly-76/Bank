<?php

namespace App\DataFixtures;

use App\Entity\AccountType;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AccountTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $accountType = new AccountType();
        $accountType->setLabel('Compte Courant');
        $manager->persist($accountType);
        $manager->flush();

        $accountType = new AccountType();
        $accountType->setLabel('PEL');
        $manager->persist($accountType);
        $manager->flush();

        $accountType = new AccountType();
        $accountType->setLabel('Livret A');
        $manager->persist($accountType);
        $manager->flush();

        $accountType = new AccountType();
        $accountType->setLabel('PERP');
        $manager->persist($accountType);
        $manager->flush();
    }
}
