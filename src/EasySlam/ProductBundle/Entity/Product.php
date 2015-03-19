<?php

namespace EasySlam\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @ORM\Column(name="price", type="integer")
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
     * @ORM\ManyToMany(targetEntity="VarianteColor", mappedBy="products", cascade="persist")
     */
    private $variantesColor;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="VarianteType", mappedBy="products", cascade="persist")
     */
    private $variantesType;


    public function __construct()
    {
        $this->variantesColor = new ArrayCollection();
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
     * @param integer $price
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
     * @return integer 
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
        $this->imageName = $this->updateAt->format('Y-m-dTH:i:s#') . $imageName;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
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
        return $this->getName();
    }
}
