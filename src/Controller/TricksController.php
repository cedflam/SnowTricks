<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TricksController extends AbstractController
{
    /**
     * Permet d'afficher le détail d'un tricks
     * 
     * @Route("/tricks/{id}", name="tricks")
     * 
     */
    public function findFigure(Request $request, EntityManagerInterface $manager, CommentRepository $commentRepo, Tricks $tricks, $id)
    {
        /* *******************Je gère l'ajout de commentaires********* */

        //Je crée un nouvel objet Comment
        $comment = new Comment();
        //Je crée le formulaire 
        $form = $this->createForm(CommentType::class, $comment);
        //Je lance la requete
        $form->handleRequest($request);
        //Je vérifie le formulaire 
        if ($form->isSubmitted() && $form->isValid()) {
            //Je lie le commentaire à l'utilisateur connecté 
            $comment->setIdAuthor($this->getUser())
                //Je lie le commentaire à la figure 
                ->setIdTricks($tricks);
            //Je persist
            $manager->persist($comment);
            //Je lance l'enregistrement 
            $manager->flush();

            //Message Flash 
            $this->addFlash(
                'success',
                "Commentaire ajouté !"
            );
        }

        //J'affiche la vue
        return $this->render('tricks/tricks_detail.html.twig', [
            'form' => $form->createView(),
            'figure' => $tricks,
            'images' => $tricks->getImages(),
            'videos' => $tricks->getVideos(),
            //Je récupère tous les commentaires qui possèdent l'id du tricks affiché par ordre descendant
            'comments' => $commentRepo->findBy(array('idTricks' => $tricks->getId()), array('dateComment' => 'DESC'))
        ]);
    }


   
    public function addFigure(){

    }

    /**
     * Permet de modifier une figure existante
     * 
     * 
     *
     * @return void
     */
    public function editFigure(){

    }


    /**
     * Permet de supprimer une figure existante
     * 
     *
     * @return void
     */
    public function deleteFigure(){

    }
}
