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
    public function getAllProducts($page)
    {
        $products = $this->productRepository->findBy(array(), null, 20, ($page - 1) * 20);

        return $products;
    }

    /**
     * Get all products which have category in criterias
     *
     * @param array $criterias
     * @return array|\Doctrine\DBAL\Driver\Statement
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getProductsByCategory($page, $criterias = array())
    {
        $query = $this->em->createQueryBuilder();
        $query->select('p')
            ->from('EasySlamProductBundle:Product', 'p')
            ->innerJoin('p.variantesCategory', 'cat')
            ->where('cat.id = ' . $criterias[0]);

        for ($i = 1; $i < count($criterias); $i++) {
            $query->orWhere('cat.id = ' . $criterias[$i]);
        }

        $query->setFirstResult(($page - 1) * 12)->setMaxResults(12);

        $products = $query->getQuery()->getResult();

        return $products;
    }

    /**
     * Get all the product which have colours in criterias
     *
     * @param array $criterias
     * @return array|\Doctrine\DBAL\Driver\Statement
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getProductsByColor($page, $criterias = array())
    {
        $query = $this->em->createQueryBuilder();
        $query->select('p')
            ->from('EasySlamProductBundle:Product', 'p')
            ->innerJoin('p.variantesColor', 'col')
            ->where('col.id = ' . $criterias[0]);

        for ($i = 1; $i < count($criterias); $i++) {
            $query->orWhere('col.id = ' . $criterias[$i]);
        }

        $query->setFirstResult(($page - 1) * 12)->setMaxResults(12);

        $products = $query->getQuery()->getResult();

        return $products;
    }

    /**
     * Get all the product which have types in criterias
     *
     * @param array $criterias
     * @return array|\Doctrine\DBAL\Driver\Statement
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getProductsByType($page, $criterias = array())
    {
        $query = $this->em->createQueryBuilder();
        $query->select('p')
            ->from('EasySlamProductBundle:Product', 'p')
            ->innerJoin('p.variantesType', 'typ')
            ->where('typ.id = ' . $criterias[0]);

        for ($i = 1; $i < count($criterias); $i++) {
            $query->orWhere('typ.id = ' . $criterias[$i]);
        }

        $query->setFirstResult(($page - 1) * 12)->setMaxResults(12);

        $products = $query->getQuery()->getResult();

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
    public function getProductsByColorType($page, $criteriasColor = array(), $criteriasType = array())
    {
        $query = $this->em->createQueryBuilder();
        $query->select('p')
            ->from('EasySlamProductBundle:Product', 'p')
            ->innerJoin('p.variantesType', 'typ')
            ->innerJoin('p.variantesColor', 'col')
            ->where('typ.id = ' . $criteriasType[0]);

        for ($i = 1; $i < count($criteriasType); $i++) {
            $query->orWhere('typ.id = ' . $criteriasType[$i]);
        }

        $query->andWhere('col.id = ' . $criteriasColor[0]);
        for ($i = 1; $i < count($criteriasColor); $i++) {
            $query->orWhere('col.id = ' . $criteriasColor[$i]);
        }

        $query->setFirstResult(($page - 1) * 12)->setMaxResults(12);

        $products = $query->getQuery()->getResult();

        return $products;
    }

    /**
     * Get all the product which have colours and type in criterias
     *
     * @param int $page
     * @param array $criteriasColor
     * @param array $criteriasCategory
     * @return array|\Doctrine\DBAL\Driver\Statement
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getProductsByColorCategory($page, $criteriasColor = array(), $criteriasCategory = array())
    {
        $query = $this->em->createQueryBuilder();
        $query->select('p')
            ->from('EasySlamProductBundle:Product', 'p')
            ->innerJoin('p.variantesCategory', 'cat')
            ->innerJoin('p.variantesColor', 'col')
            ->where('cat.id = ' . $criteriasCategory[0]);

        for ($i = 1; $i < count($criteriasCategory); $i++) {
            $query->orWhere('cat.id = ' . $criteriasCategory[$i]);
        }

        $query->andWhere('col.id = ' . $criteriasColor[0]);
        for ($i = 1; $i < count($criteriasColor); $i++) {
            $query->orWhere('col.id = ' . $criteriasColor[$i]);
        }

        $query->setFirstResult(($page - 1) * 12)->setMaxResults(12);

        $products = $query->getQuery()->getResult();

        return $products;
    }

    /**
     * Get all the product which have colours and type in criterias
     *
     * @param int $page
     * @param array $criteriasType
     * @param array $criteriasCategory
     * @return array|\Doctrine\DBAL\Driver\Statement
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getProductsByTypeCategory($page, $criteriasType = array(), $criteriasCategory = array())
    {
        $query = $this->em->createQueryBuilder();
        $query->select('p')
            ->from('EasySlamProductBundle:Product', 'p')
            ->innerJoin('p.variantesCategory', 'cat')
            ->innerJoin('p.variantesType', 'typ')
            ->where('cat.id = ' . $criteriasCategory[0]);

        for ($i = 1; $i < count($criteriasCategory); $i++) {
            $query->orWhere('cat.id = ' . $criteriasCategory[$i]);
        }

        $query->andWhere('typ.id = ' . $criteriasType[0]);
        for ($i = 1; $i < count($criteriasType); $i++) {
            $query->orWhere('typ.id = ' . $criteriasType[$i]);
        }

        $query->setFirstResult(($page - 1) * 12)->setMaxResults(12);

        $products = $query->getQuery()->getResult();

        return $products;
    }

    /**
     * Get all the product which have colours and type in criterias
     *
     * @param int $page
     * @param array $criteriasColor
     * @param array $criteriasType
     * @param array $criteriasCategory
     * @return array|\Doctrine\DBAL\Driver\Statement
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getProductsByColorTypeCategory($page, $criteriasColor = array(), $criteriasType = array(), $criteriasCategory = array())
    {
        $query = $this->em->createQueryBuilder();
        $query->select('p')
            ->from('EasySlamProductBundle:Product', 'p')
            ->innerJoin('p.variantesColor', 'col')
            ->innerJoin('p.variantesCategory', 'cat')
            ->innerJoin('p.variantesType', 'typ')
            ->where('cat.id = ' . $criteriasCategory[0]);

        for ($i = 1; $i < count($criteriasCategory); $i++) {
            $query->orWhere('cat.id = ' . $criteriasCategory[$i]);
        }

        $query->andWhere('typ.id = ' . $criteriasType[0]);
        for ($i = 1; $i < count($criteriasType); $i++) {
            $query->orWhere('typ.id = ' . $criteriasType[$i]);
        }

        $query->andWhere('col.id = ' . $criteriasColor[0]);
        for ($i = 1; $i < count($criteriasColor); $i++) {
            $query->orWhere('col.id = ' . $criteriasColor[$i]);
        }

        $query->setFirstResult(($page - 1) * 12)->setMaxResults(12);

        $products = $query->getQuery()->getResult();

        return $products;
    }
}