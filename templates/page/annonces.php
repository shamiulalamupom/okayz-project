<?php

use App\Tools\NavigationTools;

require_once _ROOTPATH_ . '/templates/header.php';
?>

<main>
    <div class="row">
        <h1>Les annonces</h1>
    </div>

    <div class="row">
        <div class="col-md-3">
            <form method="post">
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
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->getId() ?>"><?= $category->getType() ?></option>
                        <?php endforeach; ?>
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
                    <?php require _ROOTPATH_ . '/templates/ads/ad_card.php'; ?>
                <?php endforeach; ?>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= ceil($adsCount / $limit); $i++) : ?>
                        <li style="<?= ($i == $currentPage) ? 'background-color: #f64d45; border-radius: 10px;' : '' ?>" class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="<?= NavigationTools::makeRoute('ads', 'annonces'); ?>&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
</main>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>