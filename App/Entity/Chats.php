<?php

namespace App\Entity;



class Chats extends Entity
{

    public function __construct(
        protected ?int $product_id = null,
        protected ?int $sender_id = null,
        protected ?int $receiver_id = null,
        protected ?string $content = ''
    ) {}

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    public function getSenderId(): int
    {
        return $this->sender_id;
    }

    public function setSenderId(int $sender_id): void
    {
        $this->sender_id = $sender_id;
    }

    public function getReceiverId(): int
    {
        return $this->receiver_id;
    }

    public function setReceiverId(int $receiver_id): void
    {
        $this->receiver_id = $receiver_id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public static function createAndHydrate(array $data): static
    {
        $chats = new self();
        $chats->setProductId($data['product_id']);
        $chats->setSenderId($data['sender_id']);
        $chats->setReceiverId($data['receiver_id']);
        $chats->setContent($data['content']);
        return $chats;
    }
}
