<?php

namespace EasySlam\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \EasySlam\ProductBundle\Entity\Commands;

/**
 * DetailsCommand
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DetailsCommand
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var \EasySlam\ProductBundle\Entity\Commands
     *
     * @ORM\ManyToOne(targetEntity="\EasySlam\ProductBundle\Entity\Commands", inversedBy="detailsCommands")
     */
    protected $command;

    /**
     * @var \EasySlam\ProductBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="\EasySlam\ProductBundle\Entity\Product", inversedBy="detailsCommands")
     */
    protected $product;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return DetailsCommand
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return DetailsCommand
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return DetailsCommand
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return DetailsCommand
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\Commands $command
     */
    public function setCommand(Commands $command)
    {
        $this->command = $command;
    }

    /**
     * @return \EasySlam\ProductBundle\Entity\Commands
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return \EasySlam\ProductBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
