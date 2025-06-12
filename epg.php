<?php
// epg.php
// EPG verilerini göster
$config = require 'config.php';
require 'lib/EPGParser.php';

// EPG URL'si config dosyasında tanımlanmış olmalı
$epgUrl = $config['epg_url'] ?? '';
if (!$epgUrl) {
    echo '<h1>EPG URL tanımlanmamış</h1>';
    echo '<p>config.php dosyasında epg_url anahtarını tanımlayın.</p>';
    exit;
}

$parser = new EPGParser($epgUrl);
$programs = $parser->getPrograms();

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>EPG - Elektronik Program Rehberi</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav>
    <a href="index.php">Anasayfa</a>
    <a href="diziler.php">Diziler</a>
    <a href="filmler.php">Filmler</a>
    <a href="epg.php">EPG</a>
</nav>
<main>
    <h1>Elektronik Program Rehberi</h1>
    <?php if (empty($programs)): ?>
        <p>EPG verileri bulunamadı.</p>
    <?php else: ?>
        <div class="epg-list">
            <?php foreach ($programs as $program): ?>
                <div class="epg-item">
                    <h3><?= htmlspecialchars($program['channel']) ?></h3>
                    <p><strong><?= htmlspecialchars($program['title']) ?></strong></p>
                    <p><?= htmlspecialchars($program['start']) ?> - <?= htmlspecialchars($program['stop']) ?></p>
                    <?php if (!empty($program['desc'])): ?>
                        <p><?= htmlspecialchars($program['desc']) ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
</body>
</html>