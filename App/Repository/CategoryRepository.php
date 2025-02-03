<?php

namespace App\Repository;

use App\Entity\Categories;
use App\Entity\User;

class CategoryRepository extends Repository
{

    public static function findOneByCategoryId(int $id)
    {
        $query = self::$pdo->prepare("SELECT * FROM category WHERE id = :id");
        $query->bindParam(':id', $id, self::$pdo::PARAM_STR);
        $query->execute();
        $category = $query->fetch(self::$pdo::FETCH_ASSOC);
        if ($category) {
            return Categories::createAndHydrate($category);;
        } else {
            return false;
        }
    }
}
