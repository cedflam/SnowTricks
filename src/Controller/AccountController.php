<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\MimeType\ExtensionGuesser;


class AccountController extends AbstractController
{
    /**
     * Permet d'afficher et de gérer le formulaire de connexion
     * 
     * @Route("/login", name="account_login")
     * 
     * @return Response 
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('account/login.html.twig',[
            'hasError'=>$error !== null,
            'username'=>$username
        ]);
    }

    /**
     * Permet de se deconnecter
     * 
     * @Route("/logout", name="account_logout")
     *
     * @return void
     */
    public function logout(){
        //...géré par symfony
    }


    /**
     * Permet d'afficher le formulaire d'inscription 
     * 
     * @Route("/register", name="account_register")
     *
     * @return void
     */
    public function register(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder ){

        //Je crée un nouvel User 
        $user = new User();
        //Je crée le formulaire 
        $form = $this->createForm(RegistrationType::class, $user);
        //Je lance ma requete
        $form->handleRequest($request);
        //Si le formulaire est soumis et s'il est valide
        if($form->isSubmitted() && $form->isValid()){

            /******  Je traite l'image  ********/
            //!!! Enlever le type String ainsi que le Self du getter et setter concerné
            //Je récupère le nom de l'image
            $file = $user->getImgProfile();
            //Je crypte le nom de l'image
            $fileName = $encoder->encodePassword($user, $user->getImgProfile()).'.'.$file->guessExtension();
            //Je capture une erreur éventuelle
            try{
                //Je déplace l'image dans le dossier
                //upload_directory est configuré dans config/services.yaml
                $file->move($this->getParameter('upload_directory'), $fileName);
            }catch(FileException $e){
                //Code si besoin 
            }
            //J'enregistre le nom de l'image cryptée en bdd
            $user->setImgProfile($fileName);

            /*******Je traite le password ********* */
            //J'encode le password récupéré
            $hash = $encoder->encodePassword($user, $user->getHash());
            //Je paramètre le hash de mon objet User
            $user->setHash($hash);
            //Je persist
            $manager->persist($user);
            //Je lance la mise à jour en bdd
            $manager->flush();

            //Message flash
            $this->addFlash(
                'warning',
                "Il ne reste plus qu'à valider votre inscription ! Consultez vos emails !"
            );

        } 

        //J'affiche la page 
        return $this->render('account/registration.html.twig',[
            'form'=> $form->createView()
        ]);
    }
}
