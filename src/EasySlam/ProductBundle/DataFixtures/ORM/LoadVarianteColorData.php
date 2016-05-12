<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EasySlam\ProductBundle\Entity\VarianteColor;

class LoadVarianteColorData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $varianteType = new VarianteColor();
        $varianteType->setName("blue");

        $varianteType2 = new VarianteColor();
        $varianteType2->setName("red");

        $manager->persist($varianteType);
        $manager->persist($varianteType2);
        $manager->flush();

        $this->addReference('variante-blue', $varianteType);
        $this->addReference('variante-red', $varianteType2);
    }
}