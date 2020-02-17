<?php


namespace App\Tests\App\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AccountControllerTest extends WebTestCase
{
    /**
     * Permet de tester l'affichage de la page
     */
    public function testLoginReponse()
    {
        //Je crée le client http
        $client = static::createClient();
        //Je lance la requete
        $client->request('GET', '/login');
        //Je controle la reponse
        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    /**
     * Vérifie l'existence du titre de la page
     */
    public function testLoginPage()
    {
        //Je crée un client http
        $client = self::createClient();
        //Je crée la requete
        $client->request('GET', '/login');
        //Je recherche le titre
        $this->assertSelectorTextContains('html h1', 'Connexion');
    }

    /**
     * Verifie la redirection en cas d'erreur de connexion
     */
    public function testLoginWithBadCredentials()
    {
        //Je crée un client http
        $client = static::createClient();
        //Je crée la requete
        $crawler = $client->request('GET', '/login');
        //Je selectionne le bouton de connexion et je remplie le formulaire
        $form = $crawler->selectButton('Connexion')->form([
            '_username' => 'ced@gmail.com',
            '_password' => 'fakepass'
        ]);
        //Je soumets le formulaire
        $client->submit($form);
        //Je teste si je suis redirigé vers la page de login
        $this->assertResponseRedirects('http://localhost/login');
        //Je suis la redirection et je charge la page suivante
        $client->followRedirect();
        //Je verifie si j'ai un message flash de type danger
        $this->assertSelectorExists('.alert.alert-danger');
    }

    /**
     * Permet de tester la réussite de la connexion
     */
    public function testSuccessfullLogin()
    {
        //Je crée un client http
        $client = static::createClient();
        //Je crée la requete
        $crawler = $client->request('GET', '/login');
        //Je selectionne le bouton de connexion et je remplie le formulaire
        $form = $crawler->selectButton('Connexion')->form([
            '_username' => 'max@gmail.com',
            '_password' => 'password'
        ]);
        //Je soumets le formulaire
        $client->submit($form);
        //Je teste si je suis redirigé vers la page de login
        $this->assertResponseRedirects('http://localhost/');

    }


    /**
     * Permet de tester l'affichage de la page
     */
    public function testRegister()
    {
        //Je crée le client http
        $client = static::createClient();
        //Je lance la requete
        $client->request('GET', '/register');
        //Je controle la reponse
        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    /**
     * Permet de tester l'affichage de la page
     */
    public function testForgotResponse()
    {
        //Je crée le client http
        $client = static::createClient();
        //Je lance la requete
        $client->request('GET', '/forgot');
        //Je controle la reponse
        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    /**
     * Permet de l'existence du titre de la page
     */
    public function testForgotPage()
    {
        //Je crée un client http
        $client = self::createClient();
        $client->request('GET', '/forgot');
        $this->assertSelectorTextContains('html h1', 'Mot de passe oublié');
    }

    /**
     * Permet de tester l'affichage de la page
     */
    public function testValidatedResponse()
    {
        //Je crée le client http
        $client = static::createClient();
        //Je lance la requete
        $client->request('GET', '/validated/123456');
        //Je controle la reponse
        $this->assertSame(302, $client->getResponse()->getStatusCode());
    }

    /**
     * Permet de tester l'affichage de la page
     */
    public function testResetPassword()
    {
        //Je crée le client http
        $client = static::createClient();
        //Je lance la requete
        $client->request('GET', '/reset_password/123456');
        //Je controle la reponse
        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }


}