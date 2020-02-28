<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Entity\Comment;
use App\Form\FigureType;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TricksController extends AbstractController
{


    /**
     * Permet d'ajouter une nouvelle figure
     * 
     * @Route("/tricks/add", name="tricks_add")
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
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
        if ($form->isSubmitted() && $form->isValid()) {
            //Je boucle sur les images du formulaire
            foreach ($tricks->getImages() as $image) {
                $image->setIdTricks($tricks);
                $manager->persist($image);
            }
            //Je boucle sur les videos du formulaire
            foreach ($tricks->getVideos() as $video) {
                $video->setIdTricks($tricks);
                $manager->persist($video);
            }
            //Je lie le tricks à l'utilisateur connecté et je mets à jour la date d'édition
            $tricks->setIdAuthor($this->getUser());
            
            //Je verifie le champs Picture (image de présentation)
            //S'il est vide j'attribue une image par défaut 
            if(empty($tricks->getPicture())){
                $tricks->setPicture('https://static.thenounproject.com/png/683799-200.png');
            }

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
            return $this->redirectToRoute('tricks', [
                'id' => $tricks->getId()
            ]);
        }

        //Affichage de la vue du formulaire
        return $this->render('tricks/tricks_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /***************************************************************************** */

    /**
     * Permet d'afficher le détail d'une figure
     *
     * @Route("/tricks/{id}", name="tricks")
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param CommentRepository $commentRepo
     * @param Tricks $tricks
     * @return Response
     * @throws Exception
     */
    public function findFigure(Request $request, EntityManagerInterface $manager, CommentRepository $commentRepo, Tricks $tricks)
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

    /********************************************************************************** */

    /**
     * Permet de modifier une figure
     *
     * @Route("/tricks/{id}/edit", name="tricks_edit")
     *
     * @param Tricks $tricks
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     * @throws Exception
     */
    public function editFigure(Tricks $tricks, Request $request, EntityManagerInterface $manager)
    {

        //Je crée le formulaire 
        $form = $this->createForm(FigureType::class, $tricks);
        //Je lance la requete 
        $form->handleRequest($request);

        //Je vérifie le formulaire 
        if ($form->isSubmitted() && $form->isValid()) {

            //Je boucle sur les images du formulaire
            foreach ($tricks->getImages() as $image) {
                $image->setIdTricks($tricks);
                $manager->persist($image);
            }
            //Je boucle sur les videos du formulaire
            foreach ($tricks->getVideos() as $video) {
                $video->setIdTricks($tricks);
                $manager->persist($video);
            }

            //Je récupère la date             
            $editDate = new \DateTime('NOW');
            //Je lie le tricks à l'utilisateur connecté et je mets à jour la date
            $tricks->setIdAuthor($this->getUser())
                   ->setEditDate($editDate)
            ;

            //Je persist 
            $manager->persist($tricks);
            //Je lance l'enregistrement
            $manager->flush();

            //Message flash 
            $this->addflash(
                'success',
                "La modification est enregistrée !"
            );

            //Redirection 
            return $this->redirectToRoute('tricks', [
                'id' => $tricks->getId()
            ]);
        }

        return $this->render('tricks/tricks_edit.html.twig', [
            'form' => $form->createView(),
            'figure' => $tricks
        ]);
    }

    /*************************************************************************/

    /**
     * Permet de supprimer une figure 
     * 
     * @Route("/tricks/{id}/delete", name="tricks_delete")
     * @param Tricks $tricks
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function deleteFigure(Tricks $tricks, EntityManagerInterface $manager)
    {
        if($this->getUser() == $tricks->getIdAuthor()) {
            //Demande de suppression de la figure passée en paramètre
            $manager->remove($tricks);
            //Je lance la requete de suppression
            $manager->flush();
            //J'affiche un message flash
            $this->addFlash(
                'success',
                "La figure à bien été supprimée !"
            );
            //J'affiche la vue
            return $this->redirectToRoute('home');
        }
        //Message d'erreur
        $this->addFlash('danger',
                                "Vous n'êtes pas l'auteur de cette figure, accès interdit !"
        );
        //Redirection
        return $this->redirectToRoute('home');
    }
}
