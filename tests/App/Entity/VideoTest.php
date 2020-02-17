<?php


namespace App\Tests\App\Entity;


use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class VideoTest extends KernelTestCase
{
    /**
     * Permet de récupérer un objet Comment
     *
     * @return Video
     */
    public function getEntity()
    {
        return (new Video())
            ->setAddressVid("https://www.youtube.com/embed/NztroIqNBZA");
    }

    /**
     * Permet de tester s'il y à une erreur
     *
     * @param Video $video
     * @param int $number
     */
    public function assertHasError(Video $video, int $number = 0)
    {
        self::bootKernel();
        $error = self::$container->get('validator')->validate($video);
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
     * Permet de tester $adressVid
     *
     */
    public function testInvalidEntityFieldAddressVid()
    {
        $this->assertHasError($this->getEntity()->setAddressVid(''), 0);
    }
}