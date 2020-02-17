<?php


namespace App\Tests\App\Entity;


use App\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ImageTest extends KernelTestCase
{
    /**
     * Permet de récupérer un objet Comment
     *
     * @return Image
     * @throws Exception
     */
    public function getEntity()
    {
        return (new Image())
            ->setAddressImg('http://www.placehold.it/300x300');
    }

    /**
     * Permet de tester s'il y à une erreur
     *
     * @param Image $image
     * @param int $number
     */
    public function assertHasError(Image $image, int $number = 0)
    {
        self::bootKernel();
        $error = self::$container->get('validator')->validate($image);
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
     * Permet de tester $addressImg
     *
     */
    public function testInvalidEntityFielsAddressImg()
    {
        $this->assertHasError($this->getEntity()->setAddressImg('www'), 1);
    }
}