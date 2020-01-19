<?php

namespace App\Controller;


use App\Entity\Tricks;
use App\Service\Pagination;
use App\Repository\TricksRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Fonction qui permet de récupérer l'ensemble des figures
     * 
     * @Route("/{page<\d+>?1}", name="home")
     */
    public function index(TricksRepository $repo)
    {        
        //Je stocke l'ensemble des figures dans une variable
        $figures = $repo->findAll();

        //J'affiche la page et je paramètre twig
        return $this->render('home.html.twig', [
            'figures' => $figures,
            
        ]);
    }
}
