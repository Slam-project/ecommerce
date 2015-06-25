<?php

namespace EasySlam\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use EasySlam\ProductBundle\Listener;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\EntityListeners({"\EasySlam\ProductBundle\Listener\ProductListener"})
 * @Vich\Uploadable
 */
class Product
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     * @var \Symfony\Component\HttpFoundation\File\File $imageFile
     */
    protected $imageFile;

    /**
     * @ORM\Column(type="string", length=255, name="image_name")
     * @var string $imageName
     */
    protected $imageName;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime $updateAt
     */
    protected $updateAt;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="VarianteCategory", mappedBy="products", cascade="persist")
     */
    protected $variantesCategory;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="VarianteColor", mappedBy="products", cascade="persist")
     */
    protected $variantesColor;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="VarianteType", mappedBy="products", cascade="persist")
     */
    protected $variantesType;

    /**
     * @var \EasySlam\ProductBundle\Entity\DetailsCommand
     * @ORM\OneToMany(targetEntity="DetailsCommand", mappedBy="product")
     */
    protected $detailsCommands;

    /**
     * @var boolean $isPlanteSemaine
     * @ORM\Column(type="boolean")
     */
    protected $isPlanteSemaine;

    /**
     * @var boolean $isPlanteMois
     * @ORM\Column(type="boolean")
     */
    protected $isPlanteMois;

    /**
     * @var boolean $isAccessoireSemaine
     * @ORM\Column(type="boolean")
     */
    protected $isAccessoireSemaine;

    /**
     * @var boolean $isAccessoireMois
     * @ORM\Column(type="boolean")
     */
    protected $isAccessoireMois;

    /**
     * @var \EasySlam\ProductBundle\Entity\Demande $demande
     * @ORM\OneToMany(targetEntity="Demande", mappedBy="product")
     */
    protected $demandes;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->detailsCommands = new ArrayCollection();
        $this->variantesColor = new ArrayCollection();
        $this->variantesType = new ArrayCollection();
        $this->variantesCategory = new ArrayCollection();
        $this->demandes = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * Set stock
     *
     * @param integer $stock
     * @return Product
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\File $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updateAt = new \DateTime('now');
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\File\File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        //$imageName = $this->updateAt->format('Y-m-dTH:i:s#') . $imageName;
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\VarianteCategory $varianteCategory
     */
    public function addVariantesCategory(VarianteCategory $varianteCategory)
    {
        if ($this->variantesCategory->contains($varianteCategory)) {
            return;
        }

        $this->variantesCategory[] = $varianteCategory;

        if (!$varianteCategory->getProducts()->contains($this)) {
            $varianteCategory->addProduct($this);
        }
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\VarianteCategory $varianteCategory
     */
    public function removeVariantesCategory(VarianteCategory $varianteCategory)
    {
        if (!$this->variantesCategory->contains($varianteCategory)) {
            return;
        }

        $this->variantesCategory->removeElement($varianteCategory);

        if ($varianteCategory->getProducts()->contains($this)) {
            $varianteCategory->removeProduct($this);
        }
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getVariantesCategory()
    {
        return $this->variantesCategory;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getVarianteCategory()
    {
        return $this->variantesCategory;
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\VarianteColor $varianteColor
     */
    public function addVariantesColor(VarianteColor $varianteColor)
    {
        if ($this->variantesColor->contains($varianteColor)) {
            return;
        }

        $this->variantesColor[] = $varianteColor;

        if (!$varianteColor->getProducts()->contains($this)) {
            $varianteColor->addProduct($this);
        }

        return;
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\VarianteColor $varianteColor
     */
    public function removeVariantesColor(VarianteColor $varianteColor)
    {
        if (!$this->variantesColor->contains($varianteColor)) {
            return;
        }

        $this->variantesColor->removeElement($varianteColor);

        if ($varianteColor->getProducts()->contains($this)) {
            $varianteColor->removeProduct($this);
        }
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getVariantesColor()
    {
        return $this->variantesColor;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getVarianteColor()
    {
        return $this->variantesColor;
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\VarianteType $varianteType
     */
    public function addVariantesType(VarianteType $varianteType)
    {
        if ($this->variantesType->contains($varianteType)) {
            return;
        }

        $this->variantesType[] = $varianteType;

        if (!$varianteType->getProducts()->contains($this)) {
            $varianteType->addProduct($this);
        }

        return;
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\VarianteType $varianteType
     */
    public function removeVariantesType(VarianteType $varianteType)
    {
        if (!$this->variantesType->contains($varianteType)) {
            return;
        }

        $this->variantesType->removeElement($varianteType);

        if ($varianteType->getProducts()->contains($this)) {
            $varianteType->removeProduct($this);
        }
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getVariantesType()
    {
        return $this->variantesType;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getVarianteType()
    {
        return $this->variantesType;
    }

    /**
     * use by Sonata Admin Bundle
     *
     * @return string
     */
    public function __toString()
    {
        if ($this->getName() == null) {
            return "Nouveau produit";
        }
        return $this->getName();
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Product
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\DetailsCommand $detailsCommand
     */
    public function addDetailsCommand(DetailsCommand $detailsCommand)
    {
        $detailsCommand->setProduct($this);

        if (!$this->detailsCommands->contains($detailsCommand)) {
            $this->detailsCommands->add($detailsCommand);
        }
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\DetailsCommand $detailsCommand
     */
    public function removeDetailsCommand(DetailsCommand $detailsCommand)
    {
        if (!$this->variantesColor->contains($detailsCommand)) {
            return;
        }

        $this->variantesColor->removeElement($detailsCommand);
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getDetailsCommand()
    {
        return $this->detailsCommands;
    }

    /**
     * @param boolean $value
     */
    public function setIsPlanteSemaine($value)
    {
        $this->isPlanteSemaine = $value;
    }

    /**
     * @return bool
     */
    public function getIsPlanteSemaine()
    {
        return $this->isPlanteSemaine;
    }

    /**
     * @param boolean $value
     */
    public function setIsPlanteMois($value)
    {
        $this->isPlanteMois = $value;
    }

    /**
     * @return bool
     */
    public function getIsPlanteMois()
    {
        return $this->isPlanteMois;
    }

    /**
     * @param boolean $value
     */
    public function setIsAccessoireSemaine($value)
    {
        $this->isAccessoireSemaine = $value;
    }

    /**
     * @return bool
     */
    public function getIsAccessoireSemaine()
    {
        return $this->isAccessoireSemaine;
    }

    /**
     * @param boolean $value
     */
    public function setIsAccessoireMois($value)
    {
        $this->isAccessoireMois = $value;
    }

    /**
     * @return bool
     */
    public function getIsAccessoireMois()
    {
        return $this->isAccessoireMois;
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\Demande $demande
     */
    public function addDemande(Demande $demande)
    {
        if ($demande->getProduct() == $this) {
            $this->demandes[] = $demande;
        }
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\Demande $demande
     */
    public function removeDemande(Demande $demande)
    {
        if ($demande->getProduct() != $this) {
            $this->demandes->removeElement($this);
        }
    }

    /**
     * @return ArrayCollection|Demande
     */
    public function getDemandes()
    {
        return $this->demandes;
    }
}
