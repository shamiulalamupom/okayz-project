<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>

<main>
    <div class="container mt-5">
        <h2>Register</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="registerUser" class="btn btn-primary">Register</button>
        </form>
    </div>
</main>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>