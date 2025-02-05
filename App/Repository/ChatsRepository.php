<?php

namespace App\Repository;

use App\Entity\Chats;

class ChatRepository extends Repository
{
    public static function findChatsByUser(int $user_id)
    {
        $query = self::$pdo->prepare("SELECT * FROM chats WHERE sender_id = :user_id");
        $query->bindParam(':user_id', $user_id, self::$pdo::PARAM_INT);
        $query->execute();
        $chats = $query->fetchAll(self::$pdo::FETCH_ASSOC);
        if ($chats) {
            return Chats::createAndHydrate($chats);
        } else {
            return false;
        }
    }

    public static function findChatByAdAndUser(int $ad_id, string $user_id)
    {
        $query = self::$pdo->prepare("SELECT * FROM chats WHERE ad_id = :ad_id AND (sender_id = :user_id OR receiver_id = :user_id)");
        $query->bindParam(':ad_id', $ad_id, self::$pdo::PARAM_INT);
        $query->bindParam(':user_id', $user_id, self::$pdo::PARAM_STR);
        $query->execute();
        $chats = $query->fetch(self::$pdo::FETCH_ASSOC);
        if ($chats) {
            return Chats::createAndHydrate($chats);;
        } else {
            return false;
        }
    }

    public static function createChatByProductAndUser(int $ad_id, string $user_id)
    {
        $query = self::$pdo->prepare("INSERT INTO chats (ad_id, sender_id, receiver_id, content) VALUES (:ad_id, :sender_id, :receiver_id, :content)");
        $query->bindParam(':ad_id', $ad_id, self::$pdo::PARAM_INT);
        $query->bindParam(':sender_id', $user_id, self::$pdo::PARAM_STR);
        $query->bindParam(':receiver_id', $user_id, self::$pdo::PARAM_STR);
        $query->bindParam(':content', 'Bonjour', self::$pdo::PARAM_STR);
        $query->execute();
    }
}
