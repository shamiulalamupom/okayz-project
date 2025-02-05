<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>

<main>
    <div class="row">
        <h1>Les annonces</h1>
    </div>

    <div class="row">
        <div class="col-md-3">
            <form action="annonces.html" method="get">
                <h2>Filtres</h2>
                <div class="p-3 border-bottom">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Rechercher" value="" />
                </div>
                <div class="p-3 border-bottom">
                    <label for="price">Prix</label>
                    <div class="input-group">
                        <input type="number" name="min_price" id="min_price" class="form-control" placeholder="Prix minimum" value="" />
                        <span class="input-group-text">€</span>
                    </div>
                    <div class="input-group">
                        <input type="number" name="max_price" id="max_price" class="form-control" placeholder="Prix maximum" value="" />
                        <span class="input-group-text">€</span>
                    </div>
                </div>
                <div class="p-3 border-bottom">
                    <label for="category">Catégorie</label>
                    <select name="category" id="category" class="form-select">
                        <option value="">-- catégorie --</option>
                        <option value="1">Jeux vidéo</option>
                        <option value="3">Mangas</option>
                        <option value="2">Vêtements</option>
                    </select>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
            </form>
        </div>

        <div class="col-md-9">
            <div class="row">
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
                <div class="col-md-4 my-2 d-flex">
                    <div class="card w-100">
                        <img src="./assets/jeu-super-mario-wonder.jpg" class="card-img-top" alt="Super Mario Wonder Switch 1up" />
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Super Mario Wonder Switch 1up</h5>
                            <p class="card-text">19.00 €</p>
                            <div class="mt-auto">
                                <a href="#" class="btn btn-primary stretched-link w-100">Voir l'annonce</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>