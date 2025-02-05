<?php

use App\Entity\User;
use App\Tools\NavigationTools;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../assets/css/override-bootstrap.css" />
    <title>Okaz</title>
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img width="120" src="../assets/images/logo-okaz.png" alt="Logo Okaz" />
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 link-secondary <?php NavigationTools::addActiveClass('page', 'home') ?>">Accueil</a></li>
                <li><a href=<?= NavigationTools::makeRoute('ads', 'annonces') ?> class="nav-link px-2 <?php NavigationTools::addActiveClass('page', 'annonces') ?>">Annonces</a></li>
            </ul>

            <div class="col-md-3 text-end">
                <?php if (isset($_SESSION['user'])) : ?>
                    <a class="btn btn-outline-primary me-2 disabled" href=""><?=$_SESSION['user']['user_name'] ?></a>
                    <a class="btn btn-primary" href=<?=NavigationTools::makeRoute('auth', 'logout') ?>>Logout</a>
                <?php else: ?>
                    <a class="btn btn-outline-primary me-2" href=<?=NavigationTools::makeRoute('auth', 'login') ?>>Connexion</a>
                    <a class="btn btn-primary" href=<?=NavigationTools::makeRoute('user', 'register') ?>>Inscription</a>
                <?php endif; ?>
            </div>
        </header>
        <div>
            <?php if(isset($errors)): ?>
                <?php foreach($errors as $error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php endforeach; ?>
            <?php elseif(isset($messages)): ?>
                <?php foreach($messages as $message): ?>
                    <div class="alert alert-success" role="alert">
                        <?= $message ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>