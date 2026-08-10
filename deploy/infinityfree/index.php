<?php

/**
 * ============================================================
 * FILE INI untuk InfinityFree Shared Hosting
 * ============================================================
 * Taruh file ini di folder: htdocs/index.php
 *
 * Struktur folder baru di InfinityFree:
 *   /htdocs/index.php      ← file ini
 *   /htdocs/.htaccess      ← file htaccess utama
 *   /htdocs/build/         ← copy dari public/build/
 *   /htdocs/laravel/       ← SEMUA file Laravel lainnya masuk ke sini
 *   /htdocs/laravel/.htaccess ← htaccess pelindung (Deny from all)
 * ============================================================
 */

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Cek mode maintenance
if (file_exists($maintenance = __DIR__ . '/laravel/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Load Composer autoloader dari subfolder laravel/
require __DIR__ . '/laravel/vendor/autoload.php';

// Bootstrap Laravel dan tangani request
(require_once __DIR__ . '/laravel/bootstrap/app.php')
    ->handleRequest(Request::capture());
