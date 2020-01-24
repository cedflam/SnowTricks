<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\Isset_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class AccountController extends AbstractController
{
    /**
     * Permet d'afficher et de gérer le formulaire de connexion
     * 
     * @Route("/login", name="account_login")
     * 
     * @return Response 
     */
    public function login(AuthenticationUtils $utils, UserRepository $repo, Request $request)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * Permet de se deconnecter
     * 
     * @Route("/logout", name="account_logout")
     *
     * @return void
     */
    public function logout()
    {
        //...géré par symfony
    }


    /**
     * Fonction qui permet de s'inscrire
     * 
     * @Route("/register", name="account_register")
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function register(
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $encoder,
        TokenGeneratorInterface $tokenGenerator,
        MailerInterface $mailer
    ) {

        //Je crée un nouvel User 
        $user = new User();
        //Je crée le formulaire 
        $form = $this->createForm(RegistrationType::class, $user);
        //Je lance ma requete
        $form->handleRequest($request);
        //Si le formulaire est soumis et s'il est valide
        if ($form->isSubmitted() && $form->isValid()) {

            /******  Je traite l'image  ********/

            //!!! Enlever le type String ainsi que le Self du getter et setter concerné
            //Je récupère le nom de l'image
            $file = $user->getImgProfile();
            //Si le champs est vide je mets une l'image par défaut
            if (empty($file)) {

                $fileName = ('profilDefaut.png');
            } else {

                //Je crypte le nom de l'image
                $fileName = $encoder->encodePassword($user, $user->getImgProfile()) . '.' . $file->guessExtension();
                //Je capture une erreur éventuelle
                try {
                    //Je déplace l'image dans le dossier
                    //upload_directory est configuré dans config/services.yaml
                    $file->move($this->getParameter('upload_directory'), $fileName);
                } catch (FileException $e) {
                    $this->addFlash(
                        'danger',
                        "Une erreur s'est produite lors de l'upload de l'image : " . $e->getMessage()
                    );
                }
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


            /********Je traite le token*********** */

            //Je génère un token 
            $token = $tokenGenerator->generateToken();
            //Je capture une erreur éventuelle 
            try {
                //Je stocke le nouveau token dans l'objet User
                $user->setToken($token);
                //Je persist
                $manager->persist($user);
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('home');
            }

            //Je génère l'url 
            $url = $this->generateUrl('account_valid', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);
            //Je crée le message
            $email = (new Email())
                ->from('cedflam@gmail.com')
                ->to($user->getEmail())
                ->subject("Finalisation de votre inscription sur SnowTricks !")
                ->text("Bonjour, voici le token permettant de finaliser votre inscription : " . $url);

            //J'envoie le message
            $mailer->send($email);

            //J'enregistre en bdd
            $manager->flush();

            //Message flash
            $this->addFlash(
                'success',
                "Il ne reste plus qu'à valider votre inscription ! Consultez vos emails !"
            );

            //Redirection vers la page de connexion
            return $this->redirectToRoute('home');
        }

        //J'affiche la page 
        return $this->render('account/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Fonction qui gère l'envoi d'un token à l'utilisateur par mail
     * 
     * @Route("/forgot", name="account_forgot")
     *
     * @param Request $request
     * @param MailerInterface $mailer
     * @param TokenGeneratorInterface $tokenGenerator
     * @param EntityManagerInterface $manager
     * @param UserRepository $repo
     * @return Response
     */
    public function forgotPassword(
        Request $request,
        MailerInterface $mailer,
        TokenGeneratorInterface $tokenGenerator,
        EntityManagerInterface $manager,
        UserRepository $repo
    ) {

        //condition
        if ($request->isMethod('POST')) {


            //Je récupère l'email posté
            $email = $request->get('email');

            //Je vais chercher l'email de l'user avec l'email posté
            $user = $repo->findOneBy(['email' => $email]);


            //Condition si l'email n'est pas trouvé
            if ($user === null) {
                //Message flash
                $this->addFlash(
                    'danger',
                    "L'email saisi n'existe pas !"
                );
                //Redirection 
                return $this->redirectToRoute('account_login');
            }

            //Je génère un token 
            $token = $tokenGenerator->generateToken();
            //Je capture une erreur éventuelle 
            try {
                //Je stocke le nouveau token dans l'objet User
                $user->setToken($token);
                //Je persist
                $manager->persist($user);
                //J'enregistre en bdd
                $manager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('home');
            }

            //Je génère l'url 
            $url = $this->generateUrl('account_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);
            //Je crée le message
            $email = (new Email())
                ->from('cedflam@gmail.com')
                ->to($user->getEmail())
                ->subject("Réinitialisation de votre mot de passe sur SnowTricks !")
                ->text("Bonjour, voici le token permettant de réinitialiser votre mot de passe : " . $url);
            //J'envoie le message
            $mailer->send($email);

            //Message flash 
            $this->addFlash('success', "Consultez vos emails !");

            //Redirection
            return $this->redirectToRoute('home');
        }

        return $this->render('account/forgot_password.html.twig');
    }

    /**
     * Fonction qui permet de réinitialiser un mot de passe
     * 
     * @Route("/reset_password/{token}", name="account_reset_password")
     *
     * @param Request $request
     * @param String $token
     * @param UserRepository $repo
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function resetPassword(
        Request $request,
        $token,
        UserRepository $repo,
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $encoder
    ) {

        //Condition
        if ($request->isMethod('POST')) {

            //Je récupère le token
            $user = $repo->findOneBy(['token' => $token]);

            //Si le token est vide 
            if ($user === null) {
                $this->addFlash('danger', 'Token Inconnu');
                return $this->redirectToRoute('home');
            }
            //Je supprime le token et j'encode le nouveau password
            $user->setToken(null)
                ->setHash($encoder->encodePassword($user, $request->request->get('password')));
            //Je persist
            $manager->persist($user);
            //J'enregistre en bdd
            $manager->flush();

            //Message flash
            $this->addFlash('success', 'Mot de passe mis à jour');
            //Redirection
            return $this->redirectToRoute('home');
        } else {
            //Affichage de la vue
            return $this->render('account/reset_password.html.twig', ['token' => $token]);
        }
        //Affichage de la vue
        return $this->render('account/reset_password.html.twig');
    }


    /**
     * Permet de valider l'inscription d'un utilisateur
     * 
     * @Route("/validated/{token}", name="account_valid")
     *
     * @param Request $request
     * @param Strind $token
     * @param UserRepository $repo
     * @param EntityManagerInterface $manager
     * @return void
     */
    public function validRegister(
        Request $request,
        $token,
        UserRepository $repo,
        EntityManagerInterface $manager
    ) {


        //Je récupère le token
        $user = $repo->findOneBy(['token' => $token]);
        //Si le token est vide 
        if ($user === null) {
            $this->addFlash('danger', 'Token Inconnu');
            return $this->redirectToRoute('home');
        }
        //Je supprime le token 
        $user->setToken(null);
        //Je persist
        $manager->persist($user);
        //J'enregistre en bdd
        $manager->flush();


        return $this->render('account/account_valid.html.twig');
    }
}
