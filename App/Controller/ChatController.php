<?php

namespace App\Controller;

use App\Repository\ChatRepository;
use App\Repository\UserRepository;
use App\Repository\AdsRepository;

class ChatController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'chats':
                        //charger controleur annonces
                        $this->chats();
                        break;
                    default:
                        throw new \Exception("This action does not exist : " . $_GET['action']);
                        break;
                }
            } else {
                throw new \Exception("Action missing");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function chats()
    {
        $userRepository = new UserRepository();
        $user = $userRepository->findOneById($_SESSION['user_id']);
        $chatRepository = new ChatRepository();
        $chats = $chatRepository->findChatsByUser($user->getId());

        $this->render('chat/chats', [
            'chats' => $chats
        ]);
    }
}
