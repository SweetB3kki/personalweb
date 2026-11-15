<?php
declare(strict_types=1);

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$file = __DIR__ . $path;

if (preg_match('#^/(app|config|storage|database|reports|examples)(/|$)#', $path)) {
    http_response_code(403);
    exit('Доступ запрещён.');
}

if ($path !== '/' && is_file($file)) {
    return false;
}

require __DIR__ . '/index.php';
