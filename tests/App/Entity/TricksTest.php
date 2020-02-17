<?php


namespace App\Tests\App\Entity;

use App\Entity\Category;
use App\Entity\Tricks;
use App\Entity\User;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class TricksTest extends KernelTestCase
{
    /**
 * Permet de récupérer un objet Tricks
 *
 * @return Tricks
 * @throws Exception
 * @throws Exception
 */
    public function getEntity()
    {
        $user = (new User())
            ->setFirstName('paul')
            ->setLastName('durand')
            ->setUsername('paul')
            ->setHash('password')
            ->setEmail('paul.durand@gmail.com');

        $category = (new Category())
            ->setNameCategory('Grab');

        return (new Tricks())
            ->setIdAuthor($user)
            ->setIdCategory($category)
            ->setContentTricks('bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla')
            ->setSentence('bla bla bla')
            ->setPicture('picture.jpg')
            ->setAddDate(new \DateTime('NOW'))
            ->setName('Super tricks !');

    }


    /**
     * Permet de tester s'il y à une erreur
     *
     * @param Tricks $tricks
     * @param int $number
     */
    public function assertHasError(Tricks $tricks, int $number = 0)
    {
        self::bootKernel();
        $error = self::$container->get('validator')->validate($tricks);
        $this->assertCount($number, $error);
    }

    /**
     * Permet de tester si l'entity est valide
     */
    public function testValidEntity()
    {
        $this->assertHasError($this->getEntity(), 0);
    }

    /**
     * Permet de tester l'Assert de  $firstName
     * @throws Exception
     */
    public function testInvalidEntityContentTricks()
    {
        $this->assertHasError($this->getEntity()->setContentTricks(''), 1);

    }

    /**
     * Permet de tester l'Assert de $sentence
     * @throws Exception
     */
    public function testInvalidEntitySentence()
    {
        $this->assertHasError($this->getEntity()->setSentence(''), 1);
    }

    /**
     * Permet de tester l'Assert de $name
     * @throws Exception
     */
    public function testInvalidEntityName()
    {
        $this->assertHasError($this->getEntity()->setName(''), 1);
    }

}