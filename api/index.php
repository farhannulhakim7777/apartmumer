<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');

// Default ke index.php
if (empty($uri)) {
    require __DIR__ . '/../index.php';
    exit;
}

// Cek apakah ada file PHP langsung yang cocok
$target = __DIR__ . '/../' . $uri;

if (file_exists($target) && is_file($target)) {
    require $target;
    exit;
}

if (file_exists($target . '.php')) {
    require $target . '.php';
    exit;
}

// Fallback
require __DIR__ . '/../index.php';
