<?php

namespace App\Controller;

use App\Repository\UserRepository;

class AuthController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'login':
                        $this->login();
                        break;
                    case 'logout':
                        $this->logout();
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


    protected function login()
    {
        $errors = [];

        if (isset($_POST['loginUser'])) {

            $userRepository = new UserRepository();

            $user = $userRepository->findOneByEmail($_POST['email']);

            if ($user && $user->verifyPassword($_POST['password'])) {
                session_regenerate_id(true);
                $_SESSION['user'] = [
                    'id' => $user->getId(),
                    'email' => $user->getEmail(),
                    'user_name' => $user->getUserName(),
                ];
                header('location: index.php');
            } else {
                $errors[] = 'Incorrect email or password';
            }
        }

        $this->render('auth/login', [
            'errors' => $errors,
        ]);
    }


    protected function logout()
    {
        session_regenerate_id(true);
        session_destroy();
        unset($_SESSION);
        header ('location: index.php?controller=auth&action=login');
    }
}
