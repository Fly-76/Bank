<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class BankControllerTest extends WebTestCase
{
    /**
    * @dataProvider providePrivateRoutes
    */
    public function testPrivateRoutesAccess($url)
    {
        $client = static::createClient();
        
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy([
            "email" => "admin@bank.fr"
        ]);
        $client->loginUser($testUser);

        $client->request('GET', $url);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function providePrivateRoutes()
    {
        return [
            ['/'],
            ['/virement'],
            ['/new_account'],
            ['/profil']
        ];
    }

    /**
    * @dataProvider providePublicRoutes
    */
    public function testPublicRoutesAccess($url)
    {
        $client = static::createClient();

        $client->request('GET', $url);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function providePublicRoutes()
    {
        return [
            ['/login'],
            ['/blog'],
            ['/statistiques']
        ];
    }
}