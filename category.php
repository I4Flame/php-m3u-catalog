<?php
// category.php
// Belirli kategorideki öğeleri listele
$config = require 'config.php';
require 'lib/M3UParser.php';
$category = $_GET['category'] ?? '';
if (!$category) {
    header('Location: index.php');
    exit;
}
$parser = new M3UParser($config['m3u_url'], $config['exclude_types']);
$items = $parser->getItemsByCategory($category);
require 'templates/category.php';