<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HomepageRepository")
 */
class Homepage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $backgroundImage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $MainTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $consummerTitle;

    /**
     * @ORM\Column(type="text")
     */
    private $consummerText;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $consummerImage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $farmerTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $farmerImage;

    /**
     * @ORM\Column(type="text")
     */
    private $farmerText;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBackgroundImage(): ?string
    {
        return $this->backgroundImage;
    }

    public function setBackgroundImage(?string $backgroundImage): self
    {
        $this->backgroundImage = $backgroundImage;

        return $this;
    }

    public function getMainTitle(): ?string
    {
        return $this->MainTitle;
    }

    public function setMainTitle(?string $MainTitle): self
    {
        $this->MainTitle = $MainTitle;

        return $this;
    }

    public function getConsummerTitle(): ?string
    {
        return $this->consummerTitle;
    }

    public function setConsummerTitle(string $consummerTitle): self
    {
        $this->consummerTitle = $consummerTitle;

        return $this;
    }

    public function getConsummerText(): ?string
    {
        return $this->consummerText;
    }

    public function setConsummerText(string $consummerText): self
    {
        $this->consummerText = $consummerText;

        return $this;
    }

    public function getConsummerImage(): ?string
    {
        return $this->consummerImage;
    }

    public function setConsummerImage(string $consummerImage): self
    {
        $this->consummerImage = $consummerImage;

        return $this;
    }

    public function getFarmerTitle(): ?string
    {
        return $this->farmerTitle;
    }

    public function setFarmerTitle(string $farmerTitle): self
    {
        $this->farmerTitle = $farmerTitle;

        return $this;
    }

    public function getFarmerImage(): ?string
    {
        return $this->farmerImage;
    }

    public function setFarmerImage(?string $farmerImage): self
    {
        $this->farmerImage = $farmerImage;

        return $this;
    }

    public function getFarmerText(): ?string
    {
        return $this->farmerText;
    }

    public function setFarmerText(string $farmerText): self
    {
        $this->farmerText = $farmerText;

        return $this;
    }
}
