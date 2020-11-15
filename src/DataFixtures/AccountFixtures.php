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
           // this reference returns the User object created in UserFixtures
        $user = $this->getReference(UserFixtures::ADMIN_USER_REFERENCE);
        for($i = 1; $i <=10; $i++){
                $account = new Account();
                $account->setUser($user)
                        ->setAmount(50)
                        ->setOpeningDate(new \DateTime())
                        ->setAccountType("Type de compte $i");

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