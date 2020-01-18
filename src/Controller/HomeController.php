<?php

namespace App\Controller;


use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Fonction qui permet de récupérer l'ensemble des figures
     * 
     * @Route("/", name="home")
     */
    public function index(TricksRepository $tricksRepo)
    {
        //Je stocke l'ensemble des figures dans une variable
        $figures = $tricksRepo->findAll();
        
        //J'affiche la page et je paramètre twig
        return $this->render('home.html.twig',[
            'figures'=> $figures,
            
        ]);
    }
}

