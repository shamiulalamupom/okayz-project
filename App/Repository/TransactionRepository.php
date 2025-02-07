<?php

namespace App\Repository;

use App\Entity\Transaction;
use App\Entity\Ads;
use App\Entity\User;
use App\Entity\Category;

class TransactionRepository extends Repository
{

    public function findOneByTransactionId(int $id)
    {
        $query = $this->pdo->prepare("SELECT ads.id, ads.title, ads.description, ads.price, ads.image,ads.creation_date,
                                        user.id As user_id, user.user_name, user.email, user.password,
                                        transaction.id, transaction.date
                                        FROM transaction 
                                        JOIN user ON transaction.user_id = user.id
                                        JOIN ads ON transaction.ads_id = ads.id
                                        WHERE transaction.id = :id");
        $query->bindParam(':transaction_id', $id, $this->pdo::PARAM_INT);
        $query->execute();
        $transaction = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($transaction) {
            $transactionObject = new Transaction($transaction['id'], $transaction['user_id'], $transaction['ads_id'], $transaction['status']);
            return $transactionObject;
        } else {
            return false;
        }
    }


    public function persist(Transaction $transaction): bool
    {
        if ($transaction->getId() !== null) {
            $query = $this->pdo->prepare(
                'UPDATE transaction SET date = :date WHERE id = :id'
            );
            $query->bindValue(':id', $transaction->getId(), $this->pdo::PARAM_INT);
        } else {
            $query = $this->pdo->prepare(
                'INSERT INTO transaction (date, ads_id, category_id) 
                                                    VALUES (:date, :ads_id, :category_id)'
            );
        }
        $query->bindValue(':date', $transaction->getDate(), $this->pdo::PARAM_STR);
        $query->bindValue(':ads_id', $transaction->getId(), $this->pdo::PARAM_STR);
        $query->bindValue(':category_id', $transaction->getId(), $this->pdo::PARAM_STR);
        return $query->execute();
    }

    public function removeById(int $id)
    {
        $query = $this->pdo->prepare('DELETE FROM transaction WHERE id = :id');
        $query->bindParam(':id', $id, $this->pdo::PARAM_INT);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
