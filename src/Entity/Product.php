<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductFarmer", mappedBy="product", orphanRemoval=true)
     */
    private $productFarmers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductCategory", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }



    /**
     * @return Collection|ProductFarmer[]
     */
    public function getProductFarmers(): Collection
    {
        return $this->productFarmers;
    }

    public function addProductFarmer(ProductFarmer $productFarmer): self
    {
        if (!$this->productFarmers->contains($productFarmer)) {
            $this->productFarmers[] = $productFarmer;
            $productFarmer->setProduct($this);
        }

        return $this;
    }

    public function removeProductFarmer(ProductFarmer $productFarmer): self
    {
        if ($this->productFarmers->contains($productFarmer)) {
            $this->productFarmers->removeElement($productFarmer);
            // set the owning side to null (unless already changed)
            if ($productFarmer->getProduct() === $this) {
                $productFarmer->setProduct(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?ProductCategory
    {
        return $this->category;
    }

    public function setCategory(?ProductCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

}
