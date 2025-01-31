<?php

namespace App\Repository;

use App\Db\Database;

class Repository
{
    protected \PDO $pdo;

    public function __construct()
    {
        $mysql = Database::getInstance();
        $this->pdo = $mysql->getPDO();
    }

}