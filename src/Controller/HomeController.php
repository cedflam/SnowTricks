<?php

namespace App\Controller;




use App\Entity\Category;
use App\Repository\TricksRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Fonction qui permet de récupérer l'ensemble des figures
     * 
     * @Route("/", name="home")
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
