<?php
// play.php
// Videoyu oynat
$url = $_GET['url'] ?? '';
if (!$url) {
    header('Location: index.php');
    exit;
}
require 'templates/play.php';