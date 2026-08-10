<?php

/**
 * ============================================================
 * FILE INI untuk InfinityFree Shared Hosting
 * ============================================================
 * Taruh file ini di folder: htdocs/index.php
 * (bukan di folder laravel/)
 *
 * Struktur folder di InfinityFree:
 *   /htdocs/index.php      ← file ini
 *   /htdocs/.htaccess      ← file htaccess
 *   /htdocs/build/         ← copy dari public/build/
 *   /laravel/              ← semua file Laravel lainnya
 * ============================================================
 */

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Cek mode maintenance
if (file_exists($maintenance = __DIR__ . '/../laravel/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Load Composer autoloader dari folder laravel/
require __DIR__ . '/../laravel/vendor/autoload.php';

// Bootstrap Laravel dan tangani request
(require_once __DIR__ . '/../laravel/bootstrap/app.php')
    ->handleRequest(Request::capture());
