<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Entity\Comment;
use App\Form\FigureType;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TricksController extends AbstractController
{


    /**
     * Permet d'ajouter une nouvelle figure
     *
     *@Route("/tricks/add", name="tricks_add")
     *
     * @return Response
     */
    public function addFigure(Request $request, EntityManagerInterface $manager)
    {
        //Je crée un nouvel objet Tricks
        $tricks = new Tricks();
        //Je crée le formulaire 
        $form = $this->createForm(FigureType::class, $tricks);  
        //Je lance la requete 
        $form->handleRequest($request);
        //Je vérifie le formulaire 
        if($form->isSubmitted() && $form->isValid()){
            
            //Je boucle sur les images du formulaire
            foreach ($tricks->getImages() as $image) {
                $image->setIdTricks($tricks);
                $manager->persist($image);
            }
            //Je lie le tricks à l'utilisateur connecté 
            $tricks->setIdAuthor($this->getUser());

            //Je persist 
            $manager->persist($tricks);
            //Je lance l'enregistrement
            $manager->flush();

            //Message flash 
            $this->addflash(
                'success',
                "La nouvelle figure est enregistrée !"
            );

            //Redirection 
            return $this->redirectToRoute('home');

        }
        
        //Affichage de la vue
        return $this->render('tricks/tricks_add.html.twig',[
             'form'=> $form->createView(),
        ]);
    }


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



    /**
     * Permet de modifier une figure existante
     * 
     * 
     *
     * @return void
     */
    public function editFigure()
    {
    }


    /**
     * Permet de supprimer une figure existante
     * 
     *
     * @return void
     */
    public function deleteFigure()
    {
    }
}
