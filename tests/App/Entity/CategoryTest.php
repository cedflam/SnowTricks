<?php


namespace App\Tests\App\Entity;


use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryTest extends KernelTestCase
{
    /**
     * Permet de créer un nouvel objet
     * @return Category
     */
    public function getEntity() : Category
    {
        return (new Category())
            ->setNameCategory('Grab');
    }

    /**
     * Permet de tester s'il y à une erreur
     * @param Category $category
     * @param int $number
     */
    public function assertHasError(Category $category, int $number = 0 )
    {
        self::bootKernel();
        $error = self::$container->get('validator')->validate($category);
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
     * Permet de tester l'Assert de $nameCategory
     */
    public function testInvalidEntity()
    {
        $this->assertHasError($this->getEntity()->setNameCategory(''), 1);
    }


}
