<?php

namespace EasySlam\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \EasySlam\ProductBundle\Entity\EtatCommand;
use Doctrine\Common\Collections\ArrayCollection;
use EasySlam\UserBundle\Entity\User;
use \EasySlam\ProductBundle\Entity\DetailsCommand;

/**
 * Commands
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Commands
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
     * @ORM\Column(name="addressLiv", type="string", length=255)
     */
    private $addressLiv;

    /**
     * @var string
     *
     * @ORM\Column(name="cityLiv", type="string", length=100)
     */
    private $cityLiv;

    /**
     * @var string
     *
     * @ORM\Column(name="stateLiv", type="string", length=100)
     */
    private $stateLiv;

    /**
     * @var integer
     *
     * @ORM\Column(name="codePostalLiv", type="integer")
     */
    private $codePostalLiv;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLiv", type="date")
     */
    private $dateLiv;

    /**
     * @var string
     *
     * @ORM\Column(name="addressFac", type="string", length=255)
     */
    private $addressFac;

    /**
     * @var string
     *
     * @ORM\Column(name="cityFac", type="string", length=100)
     */
    private $cityFac;

    /**
     * @var string
     *
     * @ORM\Column(name="stateFac", type="string", length=100)
     */
    private $stateFac;

    /**
     * @var string
     *
     * @ORM\Column(name="codePostalFac", type="string", length=10)
     */
    private $codePostalFac;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePayement", type="date")
     */
    private $datePayement;

    /**
     * @var \EasySlam\ProductBundle\Entity\EtatCommand
     *
     * @ORM\ManyToOne(targetEntity="\EasySlam\ProductBundle\Entity\EtatCommand", inversedBy="commands")
     */
    protected $etat;

    /**
     * @var \EasySlam\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="\EasySlam\UserBundle\Entity\User", inversedBy="commands")
     */
    protected $user;

    /**
     * @var \EasySlam\ProductBundle\Entity\DetailsCommand
     *
     * @ORM\OneToMany(targetEntity="\EasySlam\ProductBundle\Entity\DetailsCommand", mappedBy="command", cascade={"persist"})
     */
    protected $detailsCommands;


    public function __construct()
    {
        $this->etat = new ArrayCollection();
        $this->detailsCommands = new ArrayCollection();
    }

    public function setId($id)
    {
        return $this;
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
     * Set addressLiv
     *
     * @param string $addressLiv
     * @return Commands
     */
    public function setAddressLiv($addressLiv)
    {
        $this->addressLiv = $addressLiv;

        return $this;
    }

    /**
     * Get addressLiv
     *
     * @return string 
     */
    public function getAddressLiv()
    {
        return $this->addressLiv;
    }

    /**
     * Set cityLiv
     *
     * @param string $cityLiv
     * @return Commands
     */
    public function setCityLiv($cityLiv)
    {
        $this->cityLiv = $cityLiv;

        return $this;
    }

    /**
     * Get cityLiv
     *
     * @return string 
     */
    public function getCityLiv()
    {
        return $this->cityLiv;
    }

    /**
     * Set stateLiv
     *
     * @param string $stateLiv
     * @return Commands
     */
    public function setStateLiv($stateLiv)
    {
        $this->stateLiv = $stateLiv;

        return $this;
    }

    /**
     * Get stateLiv
     *
     * @return string 
     */
    public function getStateLiv()
    {
        return $this->stateLiv;
    }

    /**
     * Set codePostalLiv
     *
     * @param integer $codePostalLiv
     * @return Commands
     */
    public function setCodePostalLiv($codePostalLiv)
    {
        $this->codePostalLiv = $codePostalLiv;

        return $this;
    }

    /**
     * Get codePostalLiv
     *
     * @return integer 
     */
    public function getCodePostalLiv()
    {
        return $this->codePostalLiv;
    }

    /**
     * Set dateLiv
     *
     * @param \DateTime $dateLiv
     * @return Commands
     */
    public function setDateLiv($dateLiv)
    {
        $this->dateLiv = $dateLiv;

        return $this;
    }

    /**
     * Get dateLiv
     *
     * @return \DateTime
     */
    public function getDateLiv()
    {
        return $this->dateLiv;
    }

    /**
     * Set addressFac
     *
     * @param string $addressFac
     * @return Commands
     */
    public function setAddressFac($addressFac)
    {
        $this->addressFac = $addressFac;

        return $this;
    }

    /**
     * Get addressFac
     *
     * @return string 
     */
    public function getAddressFac()
    {
        return $this->addressFac;
    }

    /**
     * Set cityFac
     *
     * @param string $cityFac
     * @return Commands
     */
    public function setCityFac($cityFac)
    {
        $this->cityFac = $cityFac;

        return $this;
    }

    /**
     * Get cityFac
     *
     * @return string 
     */
    public function getCityFac()
    {
        return $this->cityFac;
    }

    /**
     * Set stateFac
     *
     * @param string $stateFac
     * @return Commands
     */
    public function setStateFac($stateFac)
    {
        $this->stateFac = $stateFac;

        return $this;
    }

    /**
     * Get stateFac
     *
     * @return string 
     */
    public function getStateFac()
    {
        return $this->stateFac;
    }

    /**
     * Set codePostalFac
     *
     * @param string $codePostalFac
     * @return Commands
     */
    public function setCodePostalFac($codePostalFac)
    {
        $this->codePostalFac = $codePostalFac;

        return $this;
    }

    /**
     * Get codePostalFac
     *
     * @return string 
     */
    public function getCodePostalFac()
    {
        return $this->codePostalFac;
    }

    /**
     * Set datePayement
     *
     * @param \DateTime $datePayement
     * @return Commands
     */
    public function setDatePayement($datePayement)
    {
        $this->datePayement = $datePayement;

        return $this;
    }

    /**
     * Get datePayement
     *
     * @return \DateTime 
     */
    public function getDatePayement()
    {
        return $this->datePayement;
    }

    /**
     * Set etat of the command
     *
     * @param \EasySlam\ProductBundle\Entity\EtatCommand $etatCommand
     */
    public function setEtat(EtatCommand $etatCommand)
    {
        $this->etat = $etatCommand;
    }

    /**
     * Get Etat of the command
     *
     * @return \EasySlam\ProductBundle\Entity\EtatCommand
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return \EasySlam\ProductBundle\Entity\Commands
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \EasySlam\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\DetailsCommand $detailsCommand
     * @return \EasySlam\ProductBundle\Entity\Commands
     */
    public function addDetailsCommand(DetailsCommand $detailsCommand)
    {
        $this->detailsCommands->add($detailsCommand);

        return $this;
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\DetailsCommand $detailsCommand
     */
    public function removeDetailsCommand(DetailsCommand $detailsCommand)
    {
        $this->detailsCommands->removeElement($detailsCommand);
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getDetailsCommands()
    {
        return $this->detailsCommands;
    }

    public function __toString()
    {
        return "Gestion des commandes";
    }
}
