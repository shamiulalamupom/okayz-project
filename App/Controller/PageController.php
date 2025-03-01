<?php

namespace App\Controller;

use App\Repository\AdsRepository;

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
                    case 'legals':
                        //charger controleur legals
                        $this->legals();
                        break;
                    default:
                        throw new \Exception("This action does not exist: " . $_GET['action']);
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

    protected function home()
    {
        $adsRepository = new AdsRepository;
        $ads = $adsRepository->findAll(3);

        $this->render('page/home', [
            'ads' => $ads
        ]);
    }

    protected function legals()
    {
        $this->render('page/legals');
    }
}
