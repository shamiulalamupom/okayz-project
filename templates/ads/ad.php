<?php
require_once _ROOTPATH_ . '/templates/header.php';

use App\Entity\User;
use App\Tools\NavigationTools;
var_dump($_SESSION, $ad->getUser()->getId());
?>

<div class="row align-items-center">
    <!-- Text Section -->
    <div class="col-md-6">
        <h1 class="fw-bold text-dark"><?= htmlspecialchars($ad->getTitle()); ?></h1>
        <p class="text-danger fs-3"><?= number_format($ad->getPrice(), 2); ?> €</p>
        <p class="text-muted"><?= nl2br(htmlspecialchars($ad->getDescription())); ?></p>
        <!-- For Testing Purposes later will remove -->
        <p class="text-muted"><?= htmlspecialchars($ad->getCreatorName()); ?></p>
        <?php if(User::isLogged() && User::getCurrentUserId() === $ad->getUser()->getId()): ?>
            <a href="<?= NavigationTools::makeRoute('ads', 'edit') ?>&id=<?= $ad->getId() ?>" class="btn btn-warning">Edit</a>
           <a href="<?= NavigationTools::makeRoute('ads', 'delete') ?>&id=<?= $ad->getId() ?>" class="btn btn-danger">Delete</a>
        <?php else: ?>
            <a href="<?= NavigationTools::makeRoute('ads', 'buy') ?>&id=<?= $ad->getId() ?>" class="btn btn-primary">Buy</a>
        <?php endif; ?>
    </div>
    <!-- Image Section -->
    <div class="col-md-6 text-center">
        <img src="<?= htmlspecialchars($ad->getImagePath()); ?>" alt="<?= htmlspecialchars($ad->getTitle()); ?>" class="img-fluid rounded">
    </div>
</div>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>