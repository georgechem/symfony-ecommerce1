<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use App\Twig\CartInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order implements CartInterface
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
    private $uuidSession;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $uuidUserId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expireAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPaid;

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

    public function getUuidSession(): ?string
    {
        return $this->uuidSession;
    }

    public function setUuidSession(string $uuidSession): self
    {
        $this->uuidSession = $uuidSession;

        return $this;
    }

    public function getUuidUserId(): ?int
    {
        return $this->uuidUserId;
    }

    public function setUuidUserId(?int $uuidUserId): self
    {
        $this->uuidUserId = $uuidUserId;

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

    public function getExpireAt(): ?\DateTimeInterface
    {
        return $this->expireAt;
    }

    public function setExpireAt(\DateTimeInterface $expireAt): self
    {
        $this->expireAt = $expireAt;

        return $this;
    }

    public function getIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }
}
