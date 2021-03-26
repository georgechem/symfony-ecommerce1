<?php

namespace App\Entity;

use App\Repository\CartRepository;
use App\Twig\CartInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart implements CartInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $productList = [];

    /**
     * @ORM\Column(type="array")
     */
    private $productAmount = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uuid;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCompleted;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductList(): ?array
    {
        return $this->productList;
    }

    public function setProductList(array $productList): self
    {
        $this->productList = $productList;

        return $this;
    }

    public function getProductAmount(): ?array
    {
        return $this->productAmount;
    }

    public function setProductAmount(array $productAmount): self
    {
        $this->productAmount = $productAmount;

        return $this;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getIsCompleted(): ?bool
    {
        return $this->isCompleted;
    }

    public function setIsCompleted(bool $isCompleted): self
    {
        $this->isCompleted = $isCompleted;

        return $this;
    }
}
