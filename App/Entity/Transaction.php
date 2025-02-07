<?php

namespace App\Entity;

class Transaction extends Entity
{

    protected ?int $id = null;
    protected ?string $date = '';
    protected ?float $totalPrice = 0;
    protected ?User $user = null;
    protected ?Ads $ads = null;


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
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate(?string $date): self
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

    public function hydrate(array $data)
    {
        parent::hydrate($data);
        if (isset($data['user_id'])) {
            $user = new User();
            $user->setId($data['user_id']);
            $user->setUserName($data['user_name']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $this->setUser($user);
        }
        if (isset($data['ads_id'])) {
            $ads = new Ads();
            $ads->setId($data['ads_id']);
            $ads->setTitle($data['title']);
            $this->setAds($ads);
        }
    }
}
