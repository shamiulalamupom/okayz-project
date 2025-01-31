<?php

namespace App\Entity;



class User extends Entity
{
    protected ?int $id = null;
    protected ?string $email = '';
    protected ?string $password = '';
    protected ?string $first_name = '';
    protected ?string $last_name = '';
    protected ?string $role = '';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /*
        Pourrait être déplacé dans une classe UserValidator
    */
    public function validate(): array
    {
        $errors = [];
        if (empty($this->getFirstName())) {
            $errors['first_name'] = 'First name is required';
        }
        if (empty($this->getLastName())) {
            $errors['last_name'] = 'Last name is required';
        }
        if (empty($this->getEmail())) {
            $errors['email'] = 'Email is required';
        } else if (!filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email is not valid';
        }
        if (empty($this->getPassword())) {
            $errors['password'] = 'Password is required';
        }
        return $errors;
    }

    /*
        Pourrait être déplacé dans une classe Security
    */
    public function verifyPassword(string $password): bool
    {
        if (password_verify($password, $this->password)) {
            return true;
        } else {
            return false;
        }
    }

    /*
        Pourrait être déplacé dans une classe Security
    */
    public static function isLogged(): bool
    {
        return isset($_SESSION['user']);
    }

    /*
        Pourrait être déplacé dans une classe Security
    */
    public static function isAdmin(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
    }

    /*
        Pourrait être déplacé dans une classe Security
    */
    public static function isUser(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'user';
    }

    /*
        Pourrait être déplacé dans une classe Security
    */
    public static function getCurrentUserId(): int|bool
    {
        return (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) ? $_SESSION['user']['id']: false;
    }

}
