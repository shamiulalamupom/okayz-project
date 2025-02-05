<?php

namespace App\Repository;

use App\Entity\Transaction;
use App\Entity\User;

class TransactionRepository extends Repository
{

    public static function findOneByTransactionId(int $id)
    {
        $query = self::$pdo->prepare("SELECT * FROM transaction WHERE id = :id");
        $query->bindParam(':id', $id, self::$pdo::PARAM_INT);
        $query->execute();
        $transaction = $query->fetch(self::$pdo::FETCH_ASSOC);
        if ($transaction) {
            return Transaction::createAndHydrate($transaction);;
        } else {
            return false;
        }
    }
}
