<?php

namespace App\Entity;

use App\Repository\ShopContentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShopContentRepository::class)
 */
class ShopContent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     */
    private $shop;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_add;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?int
    {
        return $this->product;
    }

    public function setProduct(int $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getShop(): ?int
    {
        return $this->shop;
    }

    public function setShop(int $shop): self
    {
        $this->shop = $shop;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->date_add;
    }

    public function setDateAdd(\DateTimeInterface $date_add): self
    {
        $this->date_add = $date_add;

        return $this;
    }
}
