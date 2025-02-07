<?php

namespace App\Repository;

use App\Entity\Categories;
use App\Entity\User;

class CategoryRepository extends Repository
{

    public function findAll(): array
    {
        $query = $this->pdo->prepare("SELECT * FROM category");
        $query->execute();
        $categories = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $categoriesList = [];
        foreach ($categories as $category) {
            $categoriesList[] = Categories::createAndHydrate($category);
        }
        return $categoriesList;
    }

    public function findOneByCategoryType(string $type)
    {
        $query = $this->pdo->prepare("SELECT * FROM category WHERE type = :type");
        $query->bindParam(':type', $type, $this->pdo::PARAM_STR);
        $query->execute();
        $category = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($category) {
            return Categories::createAndHydrate($category);
        } else {
            return false;
        }
    }
}
