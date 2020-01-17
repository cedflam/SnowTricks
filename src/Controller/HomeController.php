<?php

namespace App\Controller;

use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TricksRepository $repo)
    {
        $figures = $repo->findAll();
        return $this->render('home.html.twig',[
            'figures'=> $figures
        ]);
    }
}
