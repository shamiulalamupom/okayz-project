<?php

namespace App\Repository;

use App\Entity\User;

class UserRepository extends Repository
{

    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM user WHERE id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_STR);
        $query->execute();
        $user = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($user) {
            return User::createAndHydrate($user);;
        } else {
            return false;
        }
    }
    public function findOneByEmail(string $email)
    {
        $query = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        $query->bindParam(':email', $email, $this->pdo::PARAM_STR);
        $query->execute();
        $user = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($user) {
            return User::createAndHydrate($user);;
        } else {
            return false;
        }
    }

    public function persist(User $user)
    {
        
        if ($user->getId() !== null) {
                $query = $this->pdo->prepare('UPDATE user SET user_name = :user_name, last_name = :last_name,  
                                                    email = :email, password = :password  WHERE id = :id'
                );
                $query->bindValue(':id', $user->getId(), $this->pdo::PARAM_INT);
           

        } else {
            $query = $this->pdo->prepare('INSERT INTO user (user_name, last_name, email, password, role) 
                                                    VALUES (:user_name, :last_name, :email, :password, :role)'
            );

        }

        $query->bindValue(':user_name', $user->getUserName(), $this->pdo::PARAM_STR);
        $query->bindValue(':email', $user->getEmail(), $this->pdo::PARAM_STR);
        $query->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT), $this->pdo::PARAM_STR);


        return $query->execute();
    }
}