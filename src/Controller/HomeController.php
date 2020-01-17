<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TricksRepository $tricksRepo, ImageRepository $imgRepo)
    {
        $figures = $tricksRepo->findAll();
        

        return $this->render('home.html.twig',[
            'figures'=> $figures,
            
        ]);
    }
}
