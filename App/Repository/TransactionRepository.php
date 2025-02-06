<?php

namespace App\Repository;

use App\Entity\Transaction;
use App\Entity\User;

class TransactionRepository extends Repository
{

    public function findOneByTransactionId(int $id)
    {
        $query = $this->pdo->prepare("SELECT ads.*, user.*, transaction.* FROM transaction 
                                        LEFT JOIN user ON transaction.user_id = user.id
                                        LEFT JOIN ads ON transaction.ads_id = ads.id
                                        WHERE transaction.id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_INT);
        $query->execute();
        $transaction = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($transaction) {
            $transactionObject = new Transaction($transaction['id'], $transaction['user_id'], $transaction['ads_id'], $transaction['status']);
            return $transactionObject;
        } else {
            return false;
        }
    }
}
