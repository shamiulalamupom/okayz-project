<?php

namespace App\Repository;

use App\Entity\Ads;
use App\Db\Database;

class AdsRepository extends Repository
{

    public function findAll(): array
    {
        $query = self::$pdo->prepare("SELECT * FROM ads");
        $ads = $query->fetchAll(self::$pdo::FETCH_ASSOC);
        $adsList = [];
        foreach ($ads as $ad) {
            $adsList[] = Ads::createAndHydrate($ad);
        }
        return $adsList;
    }

    public static function findOneById(int $id)
    {
        $query = self::$pdo->prepare("SELECT * FROM ads WHERE id = :id");
        $query->bindParam(':id', $id, self::$pdo::PARAM_INT);
        $query->execute();
        $ad = $query->fetch(self::$pdo::FETCH_ASSOC);
        if ($ad) {
            return Ads::createAndHydrate($ad);
        } else {
            return false;
        }
    }


    public static function findOneByCategory(string $category)
    {
        $query = self::$pdo->prepare("SELECT * FROM ads WHERE category = :category");
        $query->bindParam(':category', $category, self::$pdo::PARAM_STR);
        $query->execute();
        $ads = $query->fetch(self::$pdo::FETCH_ASSOC);
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

    public function findLatestThree(): array
    {
        $query = self::$pdo->prepare("SELECT * FROM ads ORDER BY id DESC LIMIT 3");
        $ads = $query->fetchAll(self::$pdo::FETCH_ASSOC);

        $adsList = [];
        foreach ($ads as $ad) {
            $adsList[] = Ads::createAndHydrate($ad);
        }

        return $adsList;
    }
}
