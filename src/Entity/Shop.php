<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 */
class Shop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="shops")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $buy_at;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $state;

    /**
     * @ORM\OneToMany(targetEntity=ShopContent::class, mappedBy="shop")
     */
    private $shopContents;

    public function __construct()
    {
        $this->shopContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBuyAt(): ?\DateTimeInterface
    {
        return $this->buy_at;
    }

    public function setBuyAt(\DateTimeInterface $buy_at): self
    {
        $this->buy_at = $buy_at;

        return $this;
    }

    public function getState(): ?bool
    {
        return $this->state;
    }

    public function setState(?bool $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection|ShopContent[]
     */
    public function getShopContents(): Collection
    {
        return $this->shopContents;
    }

    public function addShopContent(ShopContent $shopContent): self
    {
        if (!$this->shopContents->contains($shopContent)) {
            $this->shopContents[] = $shopContent;
            $shopContent->setShop($this);
        }

        return $this;
    }

    public function removeShopContent(ShopContent $shopContent): self
    {
        if ($this->shopContents->removeElement($shopContent)) {
            // set the owning side to null (unless already changed)
            if ($shopContent->getShop() === $this) {
                $shopContent->setShop(null);
            }
        }

        return $this;
    }
}
