<?php

namespace App\Controller;

use App\Repository\TricksRepository;
use App\Repository\CommentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TricksController extends AbstractController
{
    /**
     * Permet d'afficher le détail d'un tricks
     * 
     * @Route("/tricks/{id}", name="tricks")
     */
    public function addTricks(TricksRepository $repo, CommentRepository $commentRepo, $id)
    {
        //Je récupère le tricks depuis son id 
        $tricks = $repo->findOneById($id);
        //Je récupère les comments depuis la function findByDate créee avec le QueryBuilder
        $comments = $commentRepo->findByDate($id);
        //Je récupère les images et les videos avec la méthode get créee dans l'entité Tricks
        $images = $tricks->getImages($id);
        $videos = $tricks->getVideos($id);
        //J'affiche la vue
        return $this->render('tricks/tricks_detail.html.twig',[
            'figure'=> $tricks,
            'images'=> $images,
            'videos'=> $videos,
            'comments'=> $comments
        ]);
    }
}
