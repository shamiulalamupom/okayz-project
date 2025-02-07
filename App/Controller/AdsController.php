<?php

namespace App\Controller;

use App\Repository\AdsRepository;
use App\Repository\UserRepository;
use App\Repository\CategoryRepository;
use App\Entity\User;
use App\Entity\Ads;
use App\Entity\Category;

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
                    case 'create':
                        //charger controleur create
                        $this->create();
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
        try {
            $adsRepository = new AdsRepository();
            $ads = $adsRepository->findAll();
            $this->render('page/annonces', [
                'ads' => $ads
            ]);
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
            $ad = $adsRepository->findOneById($_GET['id']);

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

    protected function create()
    {
        try {
            if (!User::isLogged()) {
                throw new \Exception("You must be logged in to create an ad.");
            }
            $errors = [];
            $ad = new Ads();
            $categoriesRepository = new CategoryRepository();
            $categories = $categoriesRepository->findAll();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $ad->setTitle($_POST['title']);
                $ad->setDescription($_POST['description']);
                $ad->setPrice($_POST['price']);
                $ad->setImage($_POST['image']);
                $ad->setUser(User::getCurrentUser());
                $ad->setCategory($categoriesRepository->findOneByCategoryType($_POST['category']));

                // Validate ad data
                if (empty($ad->getTitle())) {
                    $errors[] = 'Title is required';
                }
                if (empty($ad->getDescription())) {
                    $errors[] = 'Description is required';
                }
                if (empty($ad->getPrice()) || !is_numeric($ad->getPrice())) {
                    $errors[] = 'Valid price is required';
                }
                if (empty($ad->getCategory())) {
                    $errors[] = 'Category is required';
                }

                // If no errors, save the ad
                if (empty($errors)) {
                    $adsRepository = new AdsRepository();
                    $adsRepository->persist($ad);
                    $ads = $adsRepository->findAll();
                    $this->render('page/annonces', [
                        'messages' => ['Ad created successfully'],
                        'ads' => $ads
                    ]);
                    return;
                }

                $this->render('ads/create_ad', [
                    'ad' => $ad,
                    'pageTitle' => 'Create Ad',
                    'errors' => $errors
                ]);
            }

            $this->render('ads/create_ad', [
                'pageTitle' => 'Create Ad',
                'categories' => $categories
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
