<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\AdsRepository;
use App\Entity\User;


class UserController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'register':
                        $this->register();
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
  
    protected function register()
    {
        try {
            $errors = [];
            $user = new User();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user->setUsername($_POST['username']);
                $user->setPassword($_POST['password']);
                $user->setEmail($_POST['email']);

                // Validate user data
                if (empty($user->getUsername())) {
                    $errors[] = 'Username is required';
                }
                if (empty($user->getPassword())) {
                    $errors[] = 'Password is required';
                }
                if (empty($user->getEmail())) {
                    $errors[] = 'Email is required';
                } elseif (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
                    $errors[] = 'Invalid email format';
                }

                // If no errors, save the user
                if (empty($errors)) {
                    $userRepository = new UserRepository();
                    $userRepository->persist($user);
                    $adsRepository = new AdsRepository();
                    $ads = $adsRepository->findAll(3);
                    $this->render('page/home', [
                        'messages' => ['User registered successfully'],
                        'ads' => $ads
                    ]);
                    return;
                }

                $this->render('user/register', [
                    'user' => '',
                    'pageTitle' => 'Register',
                    'errors' => $errors
                ]);
            }

            $this->render('user/register', [
                'pageTitle' => 'Register',
            ]);

        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        } 

    }
}
