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
}
