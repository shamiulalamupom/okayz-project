<?php

namespace App\Repository;

use App\Entity\Ads;
use App\Entity\Categories;

class AdsRepository extends Repository
{

    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM ads WHERE id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_INT);
        $query->execute();
        $ad = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($ad) {
            return Ads::createAndHydrate($ad);
        } else {
            return false;
        }
    }

    
    public function findOneByCategory(string $category)
    {
        $query = $this->pdo->prepare("SELECT * FROM ads WHERE category = :category");
        $query->bindParam(':category', $category, $this->pdo::PARAM_STR);
        $query->execute();
        $ads = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($ads) {
            return Ads::createAndHydrate($ads);;
        } else {
            return false;
        }
    }
}
