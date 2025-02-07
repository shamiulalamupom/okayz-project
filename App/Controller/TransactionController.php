<?php

namespace App\Controller;

use App\Repository\TransactionRepository;
use App\Repository\AdsRepository;
use App\Entity\User;
use App\Entity\Ads;
use App\Entity\Transaction;
use App\Tools\FileTools;

class TransactionController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'checkout':
                        //charger controleur annonces
                        $this->checkout();
                        break;
                    case 'view':
                        //charger controleur annonces
                        $this->viewTransaction();
                        break;
                    case 'create':
                        //charger controleur annonces
                        $this->createTransaction();
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

    protected function checkout()
    {
        try {

            $this->render('checkout/checkout', [
                'pageTitle' => 'transaction'
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    public function viewTransaction()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new \Exception("Transaction not found");
            }

            $transactionRepository = new TransactionRepository();
            $transaction = $transactionRepository->findOneByTransactionId($_GET['id']);

            if (!$transaction) {
                throw new \Exception("Transaction not found");
            }

            $this->render('transaction/view', [
                'transaction' => $transaction
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function createTransaction()
    {
        try {
            if (!User::isLogged()) {
                throw new \Exception("You must be logged in to create a transaction");
            }

            $error = [];
            $transaction = new Transaction();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $transaction->setUser(User::getCurrentUser());
                $transaction->setAds($_POST['ads_id']);
                $transaction->setTotalPrice($_POST['total_price']);
                $transaction->setDate(date('Y-m-d H:i:s'));

                if (empty($transaction->getAds())) {
                    $error[] = 'Ads is required';
                }
                if (empty($transaction->getTotalPrice())) {
                    $error[] = 'Total price is required';
                }

                if (empty($error)) {
                    $transactionRepository = new TransactionRepository();
                    $transactionRepository->persist($transaction);

                    $this->render('transaction/view', [
                        'transaction' => $transaction
                    ]);
                    return;
                }

                $adsRepository = new AdsRepository();
                $ads = $adsRepository->findAll();

                $this->render('transaction/create', [
                    'transaction' => $transaction,
                    'ads' => $ads,
                    'error' => $error
                ]);
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
