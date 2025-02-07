<?php
require_once _ROOTPATH_ . '/templates/header.php';
?>

<div class="row align-items-center">
    <!-- Text Section -->
    <div class="col-md-6">
        <h1 class="fw-bold text-dark"><?= htmlspecialchars($ad->getTitle()); ?></h1>
        <p class="text-danger fs-3"><?= number_format($ad->getPrice(), 2); ?> €</p>
        <p class="text-muted"><?= nl2br(htmlspecialchars($ad->getDescription())); ?></p>
        <!-- For Testing Purposes later will remove -->
        <p class="text-muted"><?= htmlspecialchars($ad->getCreatorName()); ?></p>
    </div>
    <!-- Image Section -->
    <div class="col-md-6 text-center">
        <img src="<?= htmlspecialchars($ad->getImagePath()); ?>" alt="<?= htmlspecialchars($ad->getTitle()); ?>" class="img-fluid rounded">
    </div>
</div>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>