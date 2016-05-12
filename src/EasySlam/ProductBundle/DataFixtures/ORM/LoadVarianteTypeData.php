<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EasySlam\ProductBundle\Entity\VarianteType;

class LoadVarianteTypeData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $varianteType = new VarianteType();
        $varianteType->setName("interior");

        $varianteType2 = new VarianteType();
        $varianteType2->setName("exterior");

        $manager->persist($varianteType);
        $manager->persist($varianteType2);
        $manager->flush();

        $this->addReference('variante-interior', $varianteType);
        $this->addReference('variante-exterior', $varianteType2);
    }
}