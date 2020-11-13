<?php

namespace App\DataFixtures;

use App\Entity\User;
 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $passwordEncoder;
    public const ADMIN_USER_REFERENCE = 'admin-user';
    

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user,'user01'));
        $user->setEmail('user@bank.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setLastname('Jhon');
        $user->setFirstname('Doe');
        $user->setCity('Rouen');
        $user->setZipCode('76000');
        $user->setAdress('2 Place du Général de Gaulle');
        $user->setCivility('Mr');
        $user->setBirthDate(\DateTime::createFromFormat('j-M-Y', '15-Feb-2000'));
        $user->setCreateDate(new \DateTime());

        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user,'admin01'));
        $user->setEmail('admin@bank.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setLastname('Jhonny');
        $user->setFirstname('Depp');
        $user->setCity('Rouen');
        $user->setZipCode('76000');
        $user->setAdress('4 Place Henry IV');
        $user->setCivility('Mr');
        $user->setBirthDate(\DateTime::createFromFormat('j-M-Y', '31-Jan-1970'));
        $user->setCreateDate(new \DateTime());

        $manager->persist($user);
        $manager->flush();


        $this->addReference(self::ADMIN_USER_REFERENCE, $user);






    }
}


