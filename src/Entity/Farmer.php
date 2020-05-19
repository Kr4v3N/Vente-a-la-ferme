<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\FarmerRepository")
 */
class Farmer
{
    public function __toString()
    {
        return $this->farmName;
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez renseigner votre adresse.")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez renseigner le nom de votre ferme.")
     */
    private $farmName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $farmDescription;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner votre numéro de téléphone.")
     * @Assert\Regex(pattern="/[0-9]{10}/", message="Votre numéro de téléphone n'est pas valide.")
     */
    private $phone;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"}, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductFarmer", mappedBy="farmer", orphanRemoval=true)
     */
    private $productFarmers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Consumer", inversedBy="farmers")
     */
    private $consumer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photoProfil;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photoFarm;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="farmer", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $schedule;

    /**
     * @ORM\Column(type="float", scale=8, precision=10, nullable=true)
     */
    private $lat;

    /**
     * @ORM\Column(type="float", scale=8, precision=11, nullable=true)
     */
    private $lng;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $CountView;

    public function __construct()
    {
        $this->productFarmers = new ArrayCollection();
        $this->consumer = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->user = new User();
    }

    /**
     * Calculate the sum of the scores
     * @return float|int
     */
    public function getAverageScore()
    {
        $sum = array_reduce($this->comments->toArray(), function($total, $comment){
            return $total + $comment->getRating();
        }, 0);
        if (count($this->comments) > 0) return $sum / count ($this->comments);
        return 0;
    }

    /**
     * Allows to retrieve an author's comment about a farm
     * @param \App\Entity\User $author
     * @return \App\Entity\Comment|null
     */
    public function getCommentFromAuthor(User $author)
    {
        foreach($this->comments as $comment)
        {
            if($comment->getAuthor() == $author)
                return $comment;
        }
        return null;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getFarmName(): ?string
    {
        return $this->farmName;
    }

    public function setFarmName(string $farmName): self
    {
        $this->farmName = $farmName;

        return $this;
    }

    public function getSlug() :string
    {
        return (new Slugify())->slugify($this->getFarmName());

    }

    public function getFarmDescription(): ?string
    {
        return $this->farmDescription;
    }

    public function setFarmDescription(?string $farmDescription): self
    {
        $this->farmDescription = $farmDescription;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

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
            $productFarmer->setFarmer($this);
        }

        return $this;
    }

    public function removeProductFarmer(ProductFarmer $productFarmer): self
    {
        if ($this->productFarmers->contains($productFarmer)) {
            $this->productFarmers->removeElement($productFarmer);
            // set the owning side to null (unless already changed)
            if ($productFarmer->getFarmer() === $this) {
                $productFarmer->setFarmer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Consumer[]
     */
    public function getConsumer(): Collection
    {
        return $this->consumer;
    }

    public function addConsumer(Consumer $consumer): self
    {
        if (!$this->consumer->contains($consumer)) {
            $this->consumer[] = $consumer;
        }

        return $this;
    }

    public function removeConsumer(Consumer $consumer): self
    {
        if ($this->consumer->contains($consumer)) {
            $this->consumer->removeElement($consumer);
        }

        return $this;
    }

    public function setCreateAt(\DateTime $param)
    {
    }

    public function getPassword()
    {
    }

    public function getPhotoProfil()
    {
        return $this->photoProfil;
    }

    public function setPhotoProfil($photoProfil): self
    {
        $this->photoProfil = $photoProfil;

        return $this;
    }

    public function getPhotoFarm(): ?string
    {
        return $this->photoFarm;
    }

    public function setPhotoFarm(?string $photoFarm): self
    {
        $this->photoFarm = $photoFarm;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setFarmer($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getFarmer() === $this) {
                $comment->setFarmer(null);
            }
        }

        return $this;
    }

    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    public function setSchedule(?string $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getCountView(): ?int
    {
        return $this->CountView;
    }

    public function setCountView(?int $CountView): self
    {
        $this->CountView = $CountView;

        return $this;
    }
}