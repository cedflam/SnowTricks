<?php


namespace App\Tests\App\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class TricksControllerTest extends WebTestCase
{
    /**
     * Permet de tester l'affichage de la page
     */
    public function testTricksAddResponse()
    {
        //Je crée le client http
        $client = static::createClient();
        //Je lance la requete
        $client->request('GET','/tricks/add');
        //Je controle la reponse
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    /**
     * Permet de tester l'existence du titre de la page
     */
    public function testTricksAddPage()
    {
        //Je crée le client http
        $client = static::createClient();
        //Je crée la requete
        $client->request('GET', '/tricks/add');
        //Je controle l'existence du titre de la page
        $this->assertSelectorTextContains('html h1', 'Accès interdit');
    }

    public function testTricksAdd()
    {

        $client = static::createClient();
        $client->request('POST', '/tricks/add',
            ['name' => "Test"]
        );

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    /**
     * Permet de tester l'affichage de la page
     */
    public function testTricksDetailResponse()
    {
        //Je crée le client http
        $client = static::createClient();
        //Je lance la requete
        $client->request('GET', '/tricks/4');
        //Je test la réponse
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    /**
     * Permet de tester l'existence du titre de la page
     */
    public function testTricksDetailPage()
    {
        //Je crée un client http
        $client = static::createClient();
        //Je crée la requete
        $client->request('GET', '/tricks/4');
        //Je controle le titre
        $this->assertSelectorTextContains('html h1', 'Board Slide');
    }

    /**
     * Permet de tester l'affichage de la page
     */
    public function testTricksEditResponse()
    {
        //Je crée le client http
        $client = static::createClient();
        //Je lance la requete
        $client->request('GET', '/tricks/4/edit');
        //Je test la réponse
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

}