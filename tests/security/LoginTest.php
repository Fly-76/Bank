<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();

        // Exemple de test sur la page login, 
        // ramarque : j'utilise la méthode GET car c'est l'affichage de la page qui m'interresse
        $crawler = $client->request('GET', '/login');

        // Test code reponse HTTP est ok
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // Vérif il y a une balise h1 sur la page, elle contient 'Bank'
        $this->assertSelectorTextContains('html h1', 'Bank');

        $link = $crawler
            ->filter('a:contains("Blog")')  // trouve tout les liens contenant 'Blog'
            ->eq(0)                         // selectionne le premier de la liste (dans notre cas il est seul)
            ->link()
        ;
        $crawler = $client->click($link);   // on clique dessus

        // Ensuite il est possible de faire des test sur cette nouvelle page        
        // Vérif il y a une balise h1 sur la page, elle contient 'Bank'
        // $this->assertSelectorTextContains('html h', "Toute l'actualité");

    }
}