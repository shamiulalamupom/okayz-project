<?php

namespace App\Controller;

use App\Repository\UserRepository;
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

            if (isset($_POST['saveUser'])) {
                $user->setUsername($_POST['username'] ?? '');
                $user->setPassword(password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT));
                $user->setEmail($_POST['email'] ?? '');

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
                    $this->render('user/success', [
                        'message' => 'User registered successfully'
                    ]);
                    return;
                }

                $this->render('user/add_edit', [
                    'user' => $user,
                    'pageTitle' => 'Register',
                    'errors' => $errors
                ]);
            }

            $this->render('user/add_edit', [
                'user' => '',
                'pageTitle' => 'Register',
                'errors' => ''
            ]);

        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        } 

    }
}
