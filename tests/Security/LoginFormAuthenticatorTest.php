<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginFormAuthenticatorTest extends WebTestCase
{
    public function testLoadLoginFormAuthenticator()
    {
        // https://symfony.com/doc/2.4/cookbook/testing/http_authentication.html
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin@bank.fr',
            'PHP_AUTH_PW'   => 'admin01',
        ));


        //$client = static::createClient();

        // Exemple de test sur la page login, 
        // ramarque : j'utilise la méthode GET car c'est l'affichage de la page qui m'interresse
        $crawler = $client->request('GET', '/login');

        // Vérif il y a une balise h1 sur la page, elle contient 'Bank'
        //$this->assertSelectorTextContains('html h1', 'Connectez vous');


        //$form = $crawler->selectButton('submit')->form();

        // // // set some values
        // // $form['name'] = 'Lucas';
        // // $form['form_name[subject]'] = 'Hey there!';
        
        // // submit the form
        // $crawler = $client->submit($form);



/*
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
*/        // $this->assertSelectorTextContains('html h', "Toute l'actualité");




    }

}
