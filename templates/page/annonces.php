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
                <?php foreach ($ads as $ad) : ?>
                    <div class="col-md-4 my-2 d-flex">
                        <div class="card w-100">
                            <img src="<?= htmlspecialchars($ad->getImagePath()); ?>" class="card-img-top" alt="<?= htmlspecialchars($ad->getImagePath()); ?>" />
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($ad->getTitle()); ?></h5>
                                <p class="card-text"><?= htmlspecialchars($ad->getPrice()); ?> €</p>
                                <div class="mt-auto">
                                    <a href="#" class="btn btn-primary stretched-link w-100">Voir l'annonce</a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
</main>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>