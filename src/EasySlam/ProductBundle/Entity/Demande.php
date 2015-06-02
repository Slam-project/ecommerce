<?php

namespace EasySlam\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Demande
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
     * @var \EasySlam\ProductBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="\EasySlam\ProductBundle\Entity\Product", inversedBy="demandes")
     */
    protected $product;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


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
     * @param \EasySlam\ProductBundle\Entity\Product $product
     */
    public function setProduct(Product $product)
    {
        $tempon = $this->product;
        $this->product = $product;
        $product->addDemande($this);

        if ($tempon != null) {
            $tempon->removeDemande($this);
        }
    }

    /**
     * @return \EasySlam\ProductBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return Demande
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
     * Set date
     *
     * @param \DateTime $date
     * @return Demande
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    public function __toString()
    {
        if ($this->id != null) {
            return "" . $this->id;
        }

        return "Nouvelle demande";
    }
}
