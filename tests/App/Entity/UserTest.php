<?php


namespace App\Tests\App\Entity;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    /**
     * Permet de récupérer un objet Tricks
     *
     * @return User
     * @throws Exception
     * @throws Exception
     */
    public function getEntity()
    {
        return (new User())
            ->setFirstName('paul')
            ->setLastName('durand')
            ->setUsername('paul')
            ->setHash('password')
            ->setEmail('paul.durand@gmail.com');
    }


    /**
     * Permet de tester s'il y à une erreur
     *
     * @param User $user
     * @param int $number
     */
    public function assertHasError(User $user, int $number = 0)
    {
        self::bootKernel();
        $error = self::$container->get('validator')->validate($user);
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
    public function testInvalidEntityFirstName()
    {
        $this->assertHasError($this->getEntity()->setFirstName(''), 1);

    }

    /**
     * Permet de tester l'Assert de $lastName
     * @throws Exception
     */
    public function testInvalidEntityLastName()
    {
        $this->assertHasError($this->getEntity()->setLastName(''), 1);
    }

    /**
     * Permet de tester l'Assert de $username
     * @throws Exception
     */
    public function testInvalidEntityUsername()
    {
        $this->assertHasError($this->getEntity()->setUsername(''), 1);
    }

    /**
     * Permet de tester l'Assert de $hash
     * @throws Exception
     */
    public function testInvalidEntityHash()
    {
        $this->assertHasError($this->getEntity()->setHash(''), 1);
    }
}
