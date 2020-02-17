<?php


namespace App\Tests\App\Entity;


use App\Entity\Comment;
use App\Entity\User;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommentTest extends KernelTestCase
{
    /**
     * Permet de récupérer un objet Comment
     *
     * @return Comment
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

        return (new Comment())
            ->setIdAuthor($user)
            ->setDateComment(new \DateTime())
            ->setContentComment('lorem ipsum');
    }

    /**
     * Permet de tester s'il y à une erreur
     *
     * @param Comment $comment
     * @param int $number
     */
    public function assertHasError(Comment $comment, int $number = 0)
    {
        self::bootKernel();
        $error = self::$container->get('validator')->validate($comment);
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
     * Permet de tester l'Assert de $contentComment
     *
     */
    public function testInvalidEntityContentComment()
    {
        $this->assertHasError($this->getEntity()->setContentComment(''), 1);

    }


}