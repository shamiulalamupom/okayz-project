<?php
require_once _ROOTPATH_ . '/templates/header.php';
?>

<body>
    <div class="row">
        <div class="col-md-6">
            <h1 class="fw-bold"><?= htmlspecialchars($ad->getTitle()); ?></h1>
            <p class="text-danger fs-3 fw-bold"><?= number_format($ad->getPrice(), 2); ?> €</p>
            <p class="text-muted"><?= nl2br(htmlspecialchars($ad->getDescription())); ?></p>
        </div>
        <div class="col-md-6 text-end">
            <img src="<?= htmlspecialchars($ad->getImagePath()); ?>" alt="<?= htmlspecialchars($ad->getTitle()); ?>" class="img-fluid rounded">
        </div>
    </div>
</body>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>