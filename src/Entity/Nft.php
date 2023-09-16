<?php

namespace App\Entity;

use App\Repository\NftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NftRepository::class)]
class Nft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'nfts')]
    private ?Category $category = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $releaseDate = null;

    #[ORM\OneToMany(mappedBy: 'nft', targetEntity: NftPrice::class, orphanRemoval: true)]
    private Collection $nftPrices;

    #[ORM\OneToMany(mappedBy: 'nft', targetEntity: Gallery::class)]
    private Collection $galleries;

    public function __construct()
    {
        $this->nftPrices = new ArrayCollection();
        $this->galleries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return Collection<int, NftPrice>
     */
    public function getNftPrices(): Collection
    {
        return $this->nftPrices;
    }

    public function addNftPrice(NftPrice $nftPrice): static
    {
        if (!$this->nftPrices->contains($nftPrice)) {
            $this->nftPrices->add($nftPrice);
            $nftPrice->setNft($this);
        }

        return $this;
    }

    public function removeNftPrice(NftPrice $nftPrice): static
    {
        if ($this->nftPrices->removeElement($nftPrice)) {
            // set the owning side to null (unless already changed)
            if ($nftPrice->getNft() === $this) {
                $nftPrice->setNft(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Gallery>
     */
    public function getGalleries(): Collection
    {
        return $this->galleries;
    }

    public function addGallery(Gallery $gallery): static
    {
        if (!$this->galleries->contains($gallery)) {
            $this->galleries->add($gallery);
            $gallery->setNft($this);
        }

        return $this;
    }

    public function removeGallery(Gallery $gallery): static
    {
        if ($this->galleries->removeElement($gallery)) {
            // set the owning side to null (unless already changed)
            if ($gallery->getNft() === $this) {
                $gallery->setNft(null);
            }
        }

        return $this;
    }
}
