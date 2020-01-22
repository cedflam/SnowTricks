<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Repository\TricksRepository;
use App\Repository\CommentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TricksController extends AbstractController
{
    /**
     * Permet d'afficher le détail d'un tricks
     * 
     * @Route("/tricks/{id}", name="tricks")
     * 
     */
    public function findTricks(CommentRepository $commentRepo, Tricks $tricks)
    {
        //J'affiche la vue
        return $this->render('tricks/tricks_detail.html.twig',[
            'figure'=> $tricks,
            'images'=> $tricks->getImages(),
            'videos'=> $tricks->getVideos(),
            //Je récupère tous les commentaires qui ont possèdent 
            'comments'=> $commentRepo->findBy(array('idTricks' => $tricks->getId()), array('dateComment' => 'DESC'))
        ]);
    }
}
