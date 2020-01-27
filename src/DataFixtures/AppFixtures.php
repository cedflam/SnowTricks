<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\User;
use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Tricks;
use App\Entity\Comment;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    //Propriété
    private $encoder;
    /**
     * Fonction qui permet de se servir de l'encoder dans la classe
     *
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        //Tableau d'users 
        $userTab = ['Max', 'Delphine', 'Leon'];
        //Tableau de mails 
        $mail = ['max@gmail.com', 'delphine@hotmail.fr', 'leon@gmail.com'];
        //tableau de categories
        $categories = ['Grab', 'Slide', 'Rotation', 'Flip', 'Old-School'];
        //tableau des figures
        $figures = ['Japan', 'Indy Grab', 'Nose Slide', 'Board Slide', 'Double Backside Rodeo 1080', 'Backside Triple Cork 1440', 'Corkscrew', 'Double MC Twist 1260', 'Backside Air', 'Method Air'];
        
        /*----------------------------------Je traite les USERS-------------------------------- */

        //Je boucle sur le nombre d'utilisateurs
        for ($i = 0; $i < count($userTab); $i++) {

            //Je crée un nouvel objet User 
            $user = new User();
            //Je paramètre l'objet
            $user->setUsername($userTab[$i])
                ->setEmail($mail[$i])
                ->setHash($this->encoder->encodePassword($user, 'password'));

            //Je persist l'User 
            $manager->persist($user);
        }

        /*-----------------------Je traite les catégories---------------------------- */

        //Je boucle sur le tableau de categories 
        for ($j = 0; $j < count($categories); $j++) {
            //Je crée un nouvel objet Category 
            $category = new Category();
            //Je paramètre l'objet 
            $category->setNameCategory($categories[$j]);

            //Je persist les catégories
            $manager->persist($category);
        }  
        
        /*--------------------------Je traite les tricks-------------------------------- */
        //Je boucle sur le tableau de figure
        for ($k = 0; $k < count($figures); $k++){
            //Je crée un nouvel objet Tricks
            $tricks = new Tricks();
            //Je paramètre l'objet 
            $tricks->setName($figures[$k])
                   ->setSentence('Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, incidunt!')
                   ->setContentTricks('Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Maxime consequatur excepturi fugit ab doloribus illo, 
                    itaque architecto aspernatur id molestiae voluptatem repellendus 
                    sit iste ipsa ipsum! Quisquam delectus fugit quos harum, voluptatum, 
                    tempore suscipit itaque accusantium eveniet hic modi facere. 
                    Non mollitia iste quo ab incidunt beatae, exercitationem nemo? Accusamus!
                   ')
                   
            ;
            //Je persist
            $manager->persist($tricks);
        }

        /*------------------------Je traite les commentaires------------------------*/
        //Propriété
        $date = new DateTime('2020/01/16');
        //Je boucle sur le nombre de commentaires total 
        for ($p = 0; $p < 50; $p ++){
            //Je crée un nouvel objet Comment 
            $comment = new Comment();
            //Je paramètre l'objet 
            $comment->setDateComment($date)
                    ->setContentComment('Commentaire n° '.(string)$p);
            ;
            //Je persist
            $manager->persist($comment);
        }

        /*--------------------Je traite les images------------------- */
        //Je boucle sur nombre d'images souhaitées
        for($q = 0; $q < 20; $q++){
            //Je crée un nouvel objet image 
            $image = new Image();
            //Je paramètre l'objet 
            $image->setAddressImg('http://www.placehold.it/200x200');
            //Je persist
            $manager->persist($image);
        }

        //Je boucle sur nombre d'images souhaitées
        for($r = 0; $r < 10; $r++){
            //Je crée un nouvel objet image 
            $video = new Video();
            //Je paramètre l'objet 
            $video->setAddressVid('<iframe width="200" height="125" src="https://www.youtube.com/embed/KoHzXi7Usl8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
            //Je persist
            $manager->persist($video);
        }
        
        $manager->flush();
    }
}
