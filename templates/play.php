<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Video Oynatıcı - Media Kataloğu</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav>
    <a href="index.php">Anasayfa</a>
    <a href="diziler.php">Diziler</a>
    <a href="filmler.php">Filmler</a>
</nav>
<main>
    <h1>Video Oynatıcı</h1>
    <video controls width="100%" height="400">
        <source src="<?= htmlspecialchars($url) ?>" type="video/mp4">
        <p>Tarayıcınız video oynatmayı desteklemiyor.</p>
    </video>
</main>
</body>
</html>