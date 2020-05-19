<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductFarmerRepository")
 */
class ProductFarmer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default":NULL})
     * @Assert\File(
     *     maxSize = "2000k",
     * )
     */
    private $image;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Indiquez le prix")
     * @Assert\Regex(pattern="/[0-9]/", message="Veuillez indiquer que des chiffres. Exemple : 5 ou 2.05")
     */
    private $price;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Indiquez le poids")
     * @Assert\Regex(pattern="/[0-9]/", message="Veuillez indiquer que des chiffres. Exemple : 5 ou 2.05")
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Indiquez le prix au kilo")
     * @Assert\Regex(pattern="/[0-9]/", message="Veuillez indiquer que des chiffres. Exemple : 5 ou 2.05")
     */
    private $kiloPrice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="productFarmers", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Farmer", inversedBy="productFarmers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $farmer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getKiloPrice(): ?string
    {
        return $this->kiloPrice;
    }

    public function setKiloPrice(string $kiloPrice): self
    {
        $this->kiloPrice = $kiloPrice;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getFarmer(): ?Farmer
    {
        return $this->farmer;
    }

    public function setFarmer(?Farmer $farmer): self
    {
        $this->farmer = $farmer;

        return $this;
    }
}
