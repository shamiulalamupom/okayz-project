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
                    case 'ad':
                        //charger controleur ad
                        $this->ad();
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


    protected function ad()
    {
        try {
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                throw new \Exception("Ad ID is missing.");
            }

            $adsRepository = new AdsRepository();
            $ad = $adsRepository->findById($_GET['id']);

            if (!$ad) {
                throw new \Exception("Ad not found.");
            }

            $this->render('ads/ad', [
                'ad' => $ad
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function annonces()
    {
        try {
            $adsRepository = new AdsRepository();
            $ads = $adsRepository->findAll();
            var_dump($ads);
            $this->render('page/annonces', [
                'ads' => $ads
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
