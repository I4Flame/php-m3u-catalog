<?php
// config.php
return [
    // M3U URL'nizi buraya ekleyin
    'm3u_url' => 'https://example.com/playlist.m3u',
    // Dahil etmeyeceğimiz tip etiketleri, örneğin canlı yayınlar için "#EXTINF:-1,Live"
    'exclude_types' => ['#EXTINF:-1,Live'],
];