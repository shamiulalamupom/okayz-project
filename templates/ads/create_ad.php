<?php
require_once _ROOTPATH_ . '/templates/header.php';
?>

<main>
    <div class="container mt-5">
        <h2>Create an Ad</h2>
        <form method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image URL</label>
                <input type="text" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <?php foreach ($categories as $category): ?>
                        <option <?= $category && $category->getId() == $category->getId() ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($category->getType()); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="createAd" class="btn btn-primary">Create Ad</button>
        </form>
    </div>
</main>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>