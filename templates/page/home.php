<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>

<main>
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="./assets/logo-okaz.png" class="d-block mx-lg-auto img-fluid" alt="Logo Okaz" width="400" loading="lazy" />
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Avec Okaz achetez et vendez vos objets</h1>
            <p class="lead">
                Trouvez ce que vous cherchez ou donnez une seconde vie à vos objets en un clic ! Okaz est la plateforme incontournable pour
                vendre, acheter ou échanger tout ce que vous souhaitez : vêtements, meubles, appareils électroniques, véhicules et bien plus
                encore !
            </p>
        </div>
    </div>

    <div class="row">
        <h2 class="pb-2 border-bottom">Les dernières annonces</h2>

        <div class="col-md-4 my-2 d-flex">
            <div class="card w-100">
                <img src="./assets/rocket-league.jpg" class="card-img-top" alt="Rocket League PS4" />
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Rocket League PS4</h5>
                    <p class="card-text">25.00 €</p>
                    <div class="mt-auto">
                        <a href="#" class="btn btn-primary stretched-link w-100">Voir l'annonce</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-2 d-flex">
            <div class="card w-100">
                <img src="./assets/t-shirt-mario.jpg" class="card-img-top" alt="T-Shirt Mario 1up" />
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">T-Shirt Mario 1up</h5>
                    <p class="card-text">15.00 €</p>
                    <div class="mt-auto">
                        <a href="#" class="btn btn-primary stretched-link w-100">Voir l'annonce</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-2 d-flex">
            <div class="card w-100">
                <img src="./assets/jeu-zelda.jpg" class="card-img-top" alt="The Legend of Zelda: Tears Of The Kingdom Switch" />
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">The Legend of Zelda: Tears Of The Kingdom Switch</h5>
                    <p class="card-text">35.00 €</p>
                    <div class="mt-auto">
                        <a href="#" class="btn btn-primary stretched-link w-100">Voir l'annonce</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5" id="hanging-icons">
        <h2 class="pb-2 border-bottom">Les catégories</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="col d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <div
                        class="text-centericon-square text-body-emphasis d-inline-flex align-items-center justify-content-center fs-2 flex-shrink-0 me-3">
                        <i class="bi-controller"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Jeux vidéo</h3>
                    <a href="#" class="btn btn-primary"> Voir la catégorie </a>
                </div>
            </div>
            <div class="col d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <div
                        class="text-centericon-square text-body-emphasis d-inline-flex align-items-center justify-content-center fs-2 flex-shrink-0 me-3">
                        <i class="bi-book"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Mangas</h3>
                    <a href="#" class="btn btn-primary"> Voir la catégorie </a>
                </div>
            </div>
            <div class="col d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <div
                        class="text-centericon-square text-body-emphasis d-inline-flex align-items-center justify-content-center fs-2 flex-shrink-0 me-3">
                        <i class="bi-person-fill"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Vêtements</h3>
                    <a href="#" class="btn btn-primary"> Voir la catégorie </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>