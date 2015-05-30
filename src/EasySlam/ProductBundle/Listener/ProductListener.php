<?php

namespace EasySlam\ProductBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping\PrePersist;
use EasySlam\ProductBundle\Entity\Product;
use Doctrine\ORM\EntityManager;

class ProductListener
{
    /**
     * @param \EasySlam\ProductBundle\Entity\Product $product
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $event
     */
    public function prePersist(Product $product, LifecycleEventArgs $event)
    {
        $em = $event->getEntityManager();

        $this->updateData($product, $em);
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\Product $product
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $event
     */
    public function postUpdate(Product $product, LifecycleEventArgs $event)
    {
        $em = $event->getEntityManager();

        $this->updateData($product, $em);
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\Product $product
     * @param EntityManager $em
     */
    private function updateData(Product $product, EntityManager $em)
    {
        $this->setThePlanteSemaine($product, $em);
        $this->setThePlanteMois($product, $em);
        $this->setTheAccessoireSemaine($product, $em);
        $this->setTheAccessoireMois($product, $em);
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\Product $product
     * @param EntityManager $em
     * @internal param EntityManager $event
     */
    private function setThePlanteSemaine(Product $product, EntityManager $em)
    {
        $products = $em->getRepository("EasySlamProductBundle:Product")->findBy(array('isPlanteSemaine' => true));

        if ($product->getIsPlanteSemaine()) {
            foreach ($products as $prod) {
                /** @var \EasySlam\ProductBundle\Entity\Product $prod */
                if ($prod->getId() != $product->getId()) {
                    $prod->setIsPlanteSemaine(false);
                }
            }

            $em->flush();
        }
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\Product $product
     * @param EntityManager $em
     * @internal param EntityManager $event
     */
    private function setThePlanteMois(Product $product, EntityManager $em)
    {
        $products = $em->getRepository("EasySlamProductBundle:Product")->findBy(array('isPlanteMois' => true));

        if ($product->getIsPlanteMois()) {
            foreach ($products as $prod) {
                /** @var \EasySlam\ProductBundle\Entity\Product $prod */
                if ($prod->getId() != $product->getId()) {
                    $prod->setIsPlanteMois(false);
                }
            }

            $em->flush();
        }
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\Product $product
     * @param EntityManager $em
     * @internal param EntityManager $event
     */
    private function setTheAccessoireSemaine(Product $product, EntityManager $em)
    {
        $products = $em->getRepository("EasySlamProductBundle:Product")->findBy(array('isAccessoireSemaine' => true));

        if ($product->getIsAccessoireSemaine()) {
            foreach ($products as $prod) {
                /** @var \EasySlam\ProductBundle\Entity\Product $prod */
                if ($prod->getId() != $product->getId()) {
                    $prod->setIsAccessoireSemaine(false);
                }
            }

            $em->flush();
        }
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\Product $product
     * @param EntityManager $em
     * @internal param EntityManager $event
     */
    private function setTheAccessoireMois(Product $product, EntityManager $em)
    {
        $products = $em->getRepository("EasySlamProductBundle:Product")->findBy(array('isAccessoireMois' => true));

        if ($product->getIsAccessoireMois()) {
            foreach ($products as $prod) {
                /** @var \EasySlam\ProductBundle\Entity\Product $prod */
                if ($prod->getId() != $product->getId()) {
                    $prod->setIsAccessoireMois(false);
                }
            }

            $em->flush();
        }
    }
}