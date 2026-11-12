<?php
/**
 * Mumer Room - Global Constants
 * Centralized configuration for paths and settings
 */

// Prevent direct access
if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__));
}

// Base URL Configuration
// Otomatis mendeteksi root domain di Vercel atau subfolder di XAMPP (/apartmumer)
$docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) : '';
$appRoot = str_replace('\\', '/', APP_ROOT);
$subDir = trim(str_replace($docRoot, '', $appRoot), '/');
$detectedBase = (!empty($subDir) && strpos($_SERVER['REQUEST_URI'] ?? '', '/' . $subDir) !== false) ? '/' . $subDir : '';

define('BASE_URL', $detectedBase);
define('ASSETS_URL', $detectedBase . '/assets');

// Asset Paths
define('CSS_URL', ASSETS_URL . '/css');
define('JS_URL', ASSETS_URL . '/js');
define('IMAGES_URL', ASSETS_URL . '/images');

// Directory Paths
define('CONFIG_PATH', APP_ROOT . '/config');
define('INCLUDES_PATH', APP_ROOT . '/includes');
define('ASSETS_PATH', APP_ROOT . '/assets');

// Image Directories
define('LOGO_PATH', IMAGES_URL . '/logo');
define('ROOMS_PATH', IMAGES_URL . '/rooms');
define('FACILITIES_PATH', IMAGES_URL . '/facilities');
define('GALLERY_PATH', IMAGES_URL . '/gallery');

// Security Settings
define('CSRF_TOKEN_NAME', 'csrf_token');
define('SESSION_NAME', 'mumer_session');

// Date Format
define('DATE_FORMAT', 'd F Y');
define('DATE_FORMAT_DB', 'Y-m-d');

// Pagination
define('ROOMS_PER_PAGE', 9);
define('GALLERY_PER_PAGE', 12);

// Booking Settings
define('MIN_STAY_DAYS', 1);
define('MAX_GUESTS_PER_ROOM', 4);
