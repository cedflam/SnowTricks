<?php


namespace App\Tests\App\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        //Je crée le client http
        $client = static::createClient();
        //Je lance la requete
        $client->request('GET','/');
        //Je controle la reponse
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

}