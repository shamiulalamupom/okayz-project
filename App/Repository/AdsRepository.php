<?php

namespace App\Repository;

use App\Entity\Entity;
use App\Entity\Ads;
use App\Db\Database;

class AdsRepository extends Repository
{

    public function findAll(?int $limit = null): array
    {
        if ($limit) {
            $limit = "LIMIT $limit";
        } else {
            $limit = "";
        }

        $query = $this->pdo->prepare("SELECT ads.id, ads.title, ads.description, ads.price, ads.image, ads.creation_date, 
                        user.id AS user_id, user.user_name, user.email, user.password, 
                        category.id AS category_id, category.type
                        FROM ads
                        JOIN user ON ads.user_id = user.id
                        JOIN category ON ads.category_id = category.id
                        ORDER BY ads.creation_date DESC 
                        $limit");
        $query->execute();
        $ads = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $adsList = [];
        foreach ($ads as $ad) {
            $adsList[] = Ads::createAndHydrate($ad);
        }
        return $adsList;
    }

    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT ads.id, ads.title, ads.description, ads.price, ads.image, ads.creation_date, 
                        user.id AS user_id, user.user_name, user.email, user.password, 
                        category.id AS category_id, category.type
                        FROM ads
                        JOIN user ON ads.user_id = user.id
                        JOIN category ON ads.category_id = category.id
                        WHERE ads.id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_INT);
        $query->execute();
        $ad = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($ad) {
            return Ads::createAndHydrate($ad);
        } else {
            return false;
        }
    }


    public function findOneByCategory(int $category_id)
    {
        $query = $this->pdo->prepare("SELECT ads.id, ads.title, ads.description, ads.price, ads.image, ads.creation_date, 
                        user.id AS user_id, user.user_name, user.email, user.password, 
                        category.id AS category_id, category.type
                        FROM ads
                        JOIN user ON ads.user_id = user.id
                        JOIN category ON ads.category_id = category.id
                        WHERE category_id = :category_id");
        $query->bindParam(':category_id', $category_id, $this->pdo::PARAM_INT);
        $query->execute();
        $ads = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($ads) {
            return Ads::createAndHydrate($ads);
        } else {
            return false;
        }
    }

    public function persist(Ads $ads)
    {

        if ($ads->getId() !== null) {
            $query = $this->pdo->prepare(
                'UPDATE ads SET title = :title, description = :description,  
                                                    price = :price, image = :image  WHERE id = :id'
            );
            $query->bindValue(':id', $ads->getId(), $this->pdo::PARAM_INT);
        } else {
            $query = $this->pdo->prepare(
                'INSERT INTO ads (title, description, price, image, user_id, category_id) 
                                                    VALUES (:title, :description, :price, :image, :user_id, :category_id)'
            );
        }

        $query->bindValue(':title', $ads->getTitle(), $this->pdo::PARAM_STR);
        $query->bindValue(':description', $ads->getDescription(), $this->pdo::PARAM_STR);
        $query->bindValue(':price', $ads->getPrice(), $this->pdo::PARAM_INT);
        $query->bindValue(':image', $ads->getImage(), $this->pdo::PARAM_STR);
        $query->bindValue(':user_id', $ads->getUser()->getId(), $this->pdo::PARAM_INT);
        $query->bindValue(':category_id', $ads->getCategory()->getId(), $this->pdo::PARAM_INT);


        return $query->execute();
    }

    public function removeById(int $id)
    {
        $query = $this->pdo->prepare('DELETE FROM ads WHERE id = :id');
        $query->bindParam(':id', $id, $this->pdo::PARAM_INT);
        return $query->execute();

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
