<?php

namespace App\Repository;

use App\Entity\Ads;

class AdsRepository extends Repository
{

    public static function findOneById(int $id)
    {
        $pdo = self::getPdoInstance();
        $query = $pdo->prepare("SELECT * FROM ads WHERE id = :id");
        $query->bindParam(':id', $id, $pdo::PARAM_INT);
        $query->execute();
        $ad = $query->fetch($pdo::FETCH_ASSOC);
        if ($ad) {
            return Ads::createAndHydrate($ad);
        } else {
            return false;
        }
    }

    private static function getPdoInstance()
    {
        return (new self())->pdo;
    }


    public static function findOneByCategory(string $category)
    {
        $pdo = self::getPdoInstance();
        $query = $pdo->prepare("SELECT * FROM ads WHERE category = :category");
        $query->bindParam(':category', $category, $pdo::PARAM_STR);
        $query->execute();
        $ads = $query->fetch($pdo::FETCH_ASSOC);
        if ($ads) {
            return Ads::createAndHydrate($ads);;
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
                'INSERT INTO ads (title, description, price, image) 
                                                    VALUES (:title, :description, :price, :image)'
            );
        }

        $query->bindValue(':title', $ads->getTitle(), $this->pdo::PARAM_STR);
        $query->bindValue(':description', $ads->getDescription(), $this->pdo::PARAM_STR);
        $query->bindValue(':price', $ads->getPrice(), $this->pdo::PARAM_INT);
        $query->bindValue(':image', $ads->getImage(), $this->pdo::PARAM_STR);


        return $query->execute();
    }
}
