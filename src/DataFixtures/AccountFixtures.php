<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserRepository;
 
use App\Entity\Account;
 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
 
use App\DataFixtures\UserFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class AccountFixtures extends Fixture implements DependentFixtureInterface
{
    public const ADMIN_ACCOUNT_REFERENCE = 'admin-account';

    public function load(ObjectManager $manager)
    {
        $accountType = [
            'Compte Courant', 
            'PEL', 
            'Livret A', 
            'PERP',
        ];

        // this reference returns the User object created in UserFixtures
        $user = $this->getReference(UserFixtures::ADMIN_USER_REFERENCE);
        for($i = 1; $i <=3; $i++){
                $account = new Account();
                $account->setUser($user)
                        ->setNumber(800000 + $i)
                        ->setAmount(mt_rand(-5000, 5000))
                        ->setOpeningDate(new \DateTime())
                        ->setAccountType("PEL");

            $manager->persist($account);
        }
        
        $manager->flush();
        $this->addReference(self::ADMIN_ACCOUNT_REFERENCE, $account);
    }
    
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
    

}