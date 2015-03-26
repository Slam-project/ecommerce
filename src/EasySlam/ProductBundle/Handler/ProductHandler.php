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
     * @param array[string]
     * @return array[\EasySlam\ProductBundle\Entity\Product]
     */
    public function getAllProducts()
    {
        $products = $this->productRepository->findAll();

        return $products;
    }

    /**
     * Get all the product which have colours in criterias
     *
     * @param array $criterias
     * @return array|\Doctrine\DBAL\Driver\Statement
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getProductsByColor($criterias = array())
    {
        $where = 'VC.id = ' . $criterias[0];

        for ($i = 1; $i < count($criterias); $i++) {
            $where .= ' OR VC.id = ' . $criterias[$i];
        }

        $products = $this->em->createQuery('SELECT p FROM EasySlamProductBundle:VarianteColor VC
              INNER JOIN EasySlamProductBundle:Product p
              WHERE VC MEMBER OF p.variantesColor
              AND ' . $where . '
              '
        );

        $products = $products->getResult();

        return $products;
    }

    /**
     * Get all the product which have types in criterias
     *
     * @param array $criterias
     * @return array|\Doctrine\DBAL\Driver\Statement
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getProductsByType($criterias = array())
    {
        $where = 'VT.id = ' . $criterias[0];

        for ($i = 1; $i < count($criterias); $i++) {
            $where .= ' OR VT.name = ' . $criterias[$i];
        }

        $products = $this->em->createQuery('SELECT p FROM EasySlamProductBundle:VarianteType VT
              INNER JOIN EasySlamProductBundle:Product p
              WHERE VT MEMBER OF p.variantesType
              AND ' . $where . '
              '
        );

        $products = $products->getResult();

        return $products;
    }

    /**
     * Get all the product which have colours and type in criterias
     *
     * @param array $criteriasColor
     * @param array $criteriasType
     * @return array|\Doctrine\DBAL\Driver\Statement
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getProductsByColorType($criteriasColor = array(), $criteriasType = array())
    {
        $where = '( VC.id = ' . $criteriasColor[0];

        for ($i = 1; $i < count($criteriasColor); $i++) {
            $where .= ' OR VC.id = ' . $criteriasColor[$i];
        }

        $where .= ') AND ( VT.id = ' . $criteriasType[0];
        for ($i = 1; $i < count($criteriasType); $i++) {
            $where .= ' OR VT.id = ' . $criteriasType[$i];
        }
        $where .= ')';

        $products = $this->em->createQuery('SELECT p FROM EasySlamProductBundle:VarianteType VT
              INNER JOIN EasySlamProductBundle:Product p WHERE VT MEMBER OF p.variantesType
              INNER JOIN EasySlamProductBundle:VarianteColor VC WHERE VC MEMBER OF p.variantesColor
              AND ' . $where . '
              '
        );

        $products = $products->getResult();

        return $products;
    }
}