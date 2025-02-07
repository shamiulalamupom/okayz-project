<?php

namespace App\Entity;

class Transaction extends Entity
{

    public function __construct(
        protected ?int $id = null,
        protected ?int $date = '',
        protected ?float $totalPrice = '',
        protected ?User $user = null,
        protected ?Ads $ads = null
    ) {}


    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate(?int $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of toralPrice
     */
    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    /**
     * Set the value of toralPrice
     */
    public function setTotalPrice(?float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }


    /**
     * Get the value of user
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Set the value of user
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of ads
     */
    public function getAds(): ?Ads
    {
        return $this->ads;
    }

    /**
     * Set the value of ads
     */
    public function setAds(?Ads $ads): self
    {
        $this->ads = $ads;

        return $this;
    }

    public static function createAndHydrate(array $data): static
    {
        $transaction = new self();
        $transaction->setId($data['id']);
        $transaction->setDate($data['date']);
        $transaction->setTotalPrice($data['totalPrice']);
        return $transaction;
    }
}
