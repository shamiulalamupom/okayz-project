<?php

namespace App\Controller;

use App\Repository\BookRepository;

class PageController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'home':
                        //charger controleur home
                        $this->home();
                        break;
                    default:
                        throw new \Exception("This action does not exist: ".$_GET['action']);
                        break;
                }
            } else {
                throw new \Exception("Action missing");
            }
        } catch(\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }

    }

    protected function home()
    {

        // $bookRepository = new BookRepository;
        // $books = $bookRepository->findAll(_HOME_BOOK_LIMIT_);

        $this->render('page/home');

    }

}