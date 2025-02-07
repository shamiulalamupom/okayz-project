<?php

namespace App\Controller;

use App\Repository\AdsRepository;
use App\Repository\UserRepository;
use App\Repository\CategoryRepository;
use App\Entity\User;
use App\Entity\Ads;
use App\Entity\Category;
use App\Tools\FileTools;

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
            $filters = [];

            // Assuming the form uses GET method
            if (isset($_POST['category'])) {
                $filters['type'] = $_POST['category'];
            }
            if (isset($_POST['min_price'])) {
                $filters['min_price'] = (int)$_POST['min_price'];
            }
            if (isset($_POST['max_price'])) {
                $filters['max_price'] = (int)$_POST['max_price'];
            }
            if (isset($_POST['search'])) {
                $filters['search'] = $_POST['search'];
            }

            $adsRepository = new AdsRepository();
            $ads = $adsRepository->findAll(null, $filters);
            $categoriesRepository = new CategoryRepository();
            $categories = $categoriesRepository->findAll();
            $this->render('page/annonces', [
                'ads' => $ads,
                'categories' => $categories
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
                $image = FileTools::uploadImage(_ASSETS_UPLOAD_FOLDER_, $_FILES['image']);
                $ad->setTitle($_POST['title']);
                $ad->setDescription($_POST['description']);
                $ad->setPrice($_POST['price']);
                $ad->setImage($image['fileName']);
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
                    header('Location: index.php?controller=ads&action=annonces');
                    return;
                }

                $this->render('ads/create_ad', [
                    'ad' => $ad,
                    'pageTitle' => 'Create Ad',
                    'errors' => $errors,
                    'categories' => $categories
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
