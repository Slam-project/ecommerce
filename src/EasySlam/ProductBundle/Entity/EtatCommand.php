<?php

namespace EasySlam\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \EasySlam\ProductBundle\Entity\Commands;

/**
 * EtatCommand
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class EtatCommand
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
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=30)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=7)
     */
    private $color;

    /**
     * @var boolean
     *
     * @ORM\Column(name="base", type="boolean")
     */
    private $base;

    /**
     * @ORM\OneToMany(targetEntity="\EasySlam\ProductBundle\Entity\Commands", mappedBy="etat")
     */
    private $commands;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commands = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Get etat
     *
     * @return string 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     * @return \EasySlam\ProductBundle\Entity\EtatCommand $this
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
        return $this;
    }

    /**
     * @param string $color
     * @return \EasySlam\ProductBundle\Entity\EtatCommand
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Add commands
     *
     * @param \EasySlam\ProductBundle\Entity\Commands $commands
     * @return EtatCommand
     */
    public function addCommand(Commands $commands)
    {
        $this->commands[] = $commands;

        return $this;
    }

    /**
     * Remove commands
     *
     * @param \EasySlam\ProductBundle\Entity\Commands $commands
     */
    public function removeCommand(Commands $commands)
    {
        $this->commands->removeElement($commands);
    }

    /**
     * Get commands
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * use by Sonata Admin Bundle
     *
     * @return string
     */
    public function __toString()
    {
        if ($this->getName() == null) {
            return "Nouvel état";
        }
        return $this->getName();
    }

    public function getName()
    {
        return $this->etat;
    }

    /**
     * @param boolean $base
     * @return $this
     */
    public function setBase($base)
    {
        $this->base =$base;

        return $this;
    }

    /**
     * @return bool
     */
    public function getBase()
    {
        return $this->base;
    }
}
