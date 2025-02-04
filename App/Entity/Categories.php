<?php

namespace App\Entity;



class Categories extends Entity
{

    public function __construct(
        protected ?int $id = null,
        protected ?string $type = ''
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
     * Get the value of type
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Set the value of type
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public static function createAndHydrate(array $data): static
    {
        $category = new self();
        $category->setId($data['id']);
        $category->setType($data['title']);
        return $category;
    }
}
