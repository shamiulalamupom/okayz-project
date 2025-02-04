<?php

namespace App\Controller;

use App\Repository\AdsRepository;

class AdsController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'annonces':
                        //charger controleur annonces
                        $this->annonces();
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

    protected function annonces()
    {
        $this->render('page/annonces');
    }
}
