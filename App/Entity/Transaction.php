<?php

namespace App\Entity;

class Transaction extends Entity
{

    public function __construct(
        protected ?int $id = null,
        protected ?int $date = '',
        protected ?float $toralPrice = ''
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
    public function getToralPrice(): ?float
    {
        return $this->toralPrice;
    }

    /**
     * Set the value of toralPrice
     */
    public function setToralPrice(?float $toralPrice): self
    {
        $this->toralPrice = $toralPrice;

        return $this;
    }


    public static function createAndHydrate(array $data): static
    {
        $transaction = new self();
        $transaction->setId($data['id']);
        $transaction->setDate($data['date']);
        $transaction->setToralPrice($data['toralPrice']);
        return $transaction;
    }
}
