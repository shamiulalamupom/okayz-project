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
        try {
            $errors = [];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars(trim($_POST['password']));
                if (!empty($email) && !empty($password)) {
                    $userRepository = new UserRepository();
                    $user = $userRepository->findOneByEmail($email);
                    if ($user && $user->verifyPassword($password)) {
                        session_regenerate_id(true);
                        $_SESSION['user'] = [
                            'id' => $user->getId(),
                            'email' => $user->getEmail(),
                            'user_name' => $user->getUserName(),
                        ];
                        header('Location: index.php');
                        exit;
                    } else {
                        $errors[] = 'Incorrect email or password';
                    }
                } else {
                    $errors[] = 'Email and password are required';
                }
            }

            $this->render('auth/login', [
                'errors' => $errors,
            ]);

        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }


    protected function logout()
    {
        session_regenerate_id(true);
        session_destroy();
        unset($_SESSION);
        header ('location: index.php?controller=auth&action=login');
    }
}
