<?php

namespace App\Repository;

use App\Entity\Categories;
use App\Entity\User;

class CategoryRepository extends Repository
{

    public function findOneByCategoryId(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM category WHERE id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_STR);
        $query->execute();
        $category = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($category) {
            return Categories::createAndHydrate($category);;
        } else {
            return false;
        }
    }
}
