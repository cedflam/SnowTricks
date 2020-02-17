<?php

namespace App\Controller;

use App\Repository\TricksRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Fonction qui permet de récupérer l'ensemble des figures
     *
     * @Route("/", name="home")
     * @param TricksRepository $repo
     * @return Response
     */
    public function index(TricksRepository $repo)
    {        
       
        //Je stocke l'ensemble des figures dans une variable
        $figures = $repo->findByCategory();

        //J'affiche la page et je paramètre twig
        return $this->render('home.html.twig', [
            'figures' => $figures,

        ]);
    }
}
