<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>

<main>
    <h1>Chat about: <?= htmlspecialchars($product['title']) ?></h1>
    <div id="chat-box">
        <?php foreach ($messages as $message): ?>
            <p><strong><?= $message['sender_id'] === $_SESSION['user_id'] ? 'You' : 'Seller' ?>:</strong> <?= htmlspecialchars($message['content']) ?></p>
        <?php endforeach; ?>
    </div>
    <form action="/messages/send" method="POST">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <input type="hidden" name="receiver_id" value="<?= $product['user_id'] ?>">
        <input type="text" name="content" placeholder="Type your message...">
        <button type="submit">Send</button>
    </form>
</main>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>