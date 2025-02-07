<?php

namespace App\Entity;

use App\Repository\UserRepository;

class Ads extends Entity
{
    protected ?int $id = null;
    protected ?string $title = '';
    protected ?string $description = '';
    protected ?float $price = 0;
    protected ?string $image = '';
    protected ?User $user = null;
    protected ?Categories $category = null;

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
     * Get the value of title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice(?float $price): self
    {
        if ($price < 0) {
            throw new \InvalidArgumentException("Price cannot be negative.");
        }
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getCreatorName(): string
    {
        $user = $this->getUser();
        if (!empty($user)) {
            return $user->getUserName();
        } else {
            return 'Unknown';
        }
    }

    /**
     * Get the value of category
     */
    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    /**
     * Set the value of category
     */
    public function setCategory(?Categories $category): self
    {
        $this->category = $category;

        return $this;
    }


    public function getImagePath(): string
    {
        if (!empty($this->getImage())) {
            return _ASSETS_IMAGES_FOLDER_ . $this->getImage();
        } else {
            return _ASSETS_DEFAULTS_FOLDER_ . 'EmptyCart.jpeg';
        }
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

        if (isset($data['category_id'])) {
            $category = new Categories();
            $category->setId($data['category_id']);
            $category->setType($data['type']);
            $this->setCategory($category);
        }
    }
}
