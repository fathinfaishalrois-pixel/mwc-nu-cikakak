<?php

declare(strict_types=1);

use Illuminate\Http\Request;

// Vercel routes requests through this single PHP function. Serve public assets
// directly from the deployed bundle; never expose PHP source or project files.
$publicRoot = realpath(__DIR__ . '/../public');
$uriPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$decodedPath = rawurldecode($uriPath);
$extension = strtolower(pathinfo($decodedPath, PATHINFO_EXTENSION));
$staticExtensions = ['css', 'js', 'mjs', 'map', 'png', 'jpg', 'jpeg', 'gif', 'webp', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'otf', 'eot', 'webmanifest', 'txt'];

if ($publicRoot && in_array($extension, $staticExtensions, true)) {
    $candidate = realpath($publicRoot . DIRECTORY_SEPARATOR . ltrim($decodedPath, '/'));
    $prefix = rtrim($publicRoot, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

    if ($candidate && str_starts_with($candidate, $prefix) && is_file($candidate)) {
        $mime = function_exists('mime_content_type') ? mime_content_type($candidate) : false;
        header('Content-Type: ' . ($mime ?: 'application/octet-stream'));
        header('X-Content-Type-Options: nosniff');
        header('Cache-Control: public, max-age=3600, stale-while-revalidate=86400');
        header('Content-Length: ' . (string) filesize($candidate));
        readfile($candidate);
        exit;
    }
}

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Vercel's deployed filesystem is read-only except /tmp. Laravel's compiled
// Blade views, file sessions, and local cache must never be written into the bundle.
$storagePath = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . '/mwc-nu-cikakak';
$directories = [
    'app/private', 'app/public', 'framework/cache/data',
    'framework/sessions', 'framework/testing', 'framework/views', 'logs',
];
foreach ($directories as $directory) {
    $path = $storagePath . DIRECTORY_SEPARATOR . $directory;
    if (! is_dir($path)) {
        mkdir($path, 0775, true);
    }
}
$app->useStoragePath($storagePath);

$app->handleRequest(Request::capture());
