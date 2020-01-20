<?php

namespace App\Controller;

use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TricksController extends AbstractController
{
    /**
     * Permet d'afficher le détail d'un tricks
     * 
     * @Route("/tricks/{id}", name="tricks")
     */
    public function addTricks(TricksRepository $repo ,$id)
    {
        $tricks = $repo->findOneById($id);
        $images = $tricks->getImages($id);
        $videos = $tricks->getVideos($id);
        return $this->render('tricks/tricks_detail.html.twig',[
            'figure'=> $tricks,
            'images'=> $images,
            'videos'=> $videos
        ]);
    }
}
