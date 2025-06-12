<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($category) ?> - Media Kataloğu</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav>
    <a href="index.php">Anasayfa</a>
    <a href="diziler.php">Diziler</a>
    <a href="filmler.php">Filmler</a>
</nav>
<main>
    <h1><?= htmlspecialchars($category) ?></h1>
    <?php if (empty($items)): ?>
        <p>Bu kategoride öğe bulunamadı.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($items as $item): ?>
                <li>
                    <a href="play.php?url=<?= urlencode($item['url']) ?>">
                        <?= htmlspecialchars($item['title']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</main>
</body>
</html>