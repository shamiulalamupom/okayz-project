<?php

use App\Tools\NavigationTools; 
?>
<div class="col-md-4 my-2 d-flex">
    <div class="card w-100">
        <img src="<?= htmlspecialchars($ad->getImagePath()); ?>" class="card-img-top" alt="<?= htmlspecialchars($ad->getImagePath()); ?>" />
        <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($ad->getTitle()); ?></h5>
            <p class="card-text"><?= htmlspecialchars($ad->getPrice()); ?>€</p>
            <div class="mt-auto">
                <a href="<?= NavigationTools::makeRoute("ads", "ad") ?>&id=<?= htmlspecialchars($ad->getId()); ?>" class="btn btn-primary stretched-link w-100">Voir l'annonce</a>
            </div>
        </div>
    </div>
</div>