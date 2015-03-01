<?php

namespace EasySlam\ProductBundle\Handler;

use Doctrine\ORM\EntityManager;
use EasySlam\ProductBundle\Entity\Product;

class ProductHandler
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    private $productRepository;

    /**
     * Initialise the EntityManager and the repository Product
     *
     * @param EntityManager $em
     * @internal param $ |Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->productRepository = $this->em->getRepository('EasySlamProductBundle:Product');
    }

    /**
     * Add a product to database
     *
     * @param string $name
     * @param string $description
     * @param int $price
     * @param int $stock
     */
    public function addProduct($name, $description, $price, $stock)
    {
        $product = new Product();
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice($price);
        $product->setStock($stock);

        $this->em->persist($product);
        $this->em->flush();
    }

    /**
     * Return all the
     *
     * @return array[\EasySlam\ProductBundle\Entity\Product]
     */
    public function getAllProducts()
    {
        $products = $this->productRepository->findAll();

        return $products;
    }
}