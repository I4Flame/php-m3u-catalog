<?php
// index.php
// Ana sayfa: kategori listesi
$config = require 'config.php';
require 'lib/M3UParser.php';
$parser = new M3UParser($config['m3u_url'], $config['exclude_types']);
$items = $parser->getItems();
$categories = [];
foreach ($items as $item) {
    $categories[$item['group']] = true;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Media Kataloğu</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav>
    <a href="index.php">Anasayfa</a>
    <a href="diziler.php">Diziler</a>
    <a href="filmler.php">Filmler</a>
</nav>
<main>
    <h1>Kategoriler</h1>
    <ul>
        <?php foreach ($categories as $cat => $_): ?>
            <li><a href="category.php?category=<?= urlencode($cat) ?>"><?= htmlspecialchars($cat) ?></a></li>
        <?php endforeach; ?>
    </ul>
</main>
</body>
</html>