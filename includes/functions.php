<?php
/**
 * Mumer Room - Helper Functions
 * Common utility functions used throughout the application
 */

// Prevent direct access
if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__));
}

require_once CONFIG_PATH . '/constants.php';
require_once CONFIG_PATH . '/business.php';
require_once INCLUDES_PATH . '/security.php';

/**
 * Get base URL
 */
function baseUrl($path = '') {
    return BASE_URL . '/' . ltrim($path, '/');
}

/**
 * Get asset URL
 */
function assetUrl($path) {
    return ASSETS_URL . '/' . ltrim($path, '/');
}

/**
 * Get image URL
 */
function imageUrl($path) {
    return IMAGES_URL . '/' . ltrim($path, '/');
}

/**
 * Format date for display
 */
function formatDate($date, $format = DATE_FORMAT) {
    $d = new DateTime($date);
    return $d->format($format);
}

/**
 * Truncate text
 */
function truncateText($text, $length = 100) {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . '...';
}

/**
 * Generate WhatsApp message for booking
 */
function generateWhatsAppMessage($bookingData) {
    $message = "Halo Mumer Room, saya ingin mengajukan booking apartemen di Paragon Village Karawaci.\n\n";
    $message .= "Berikut detail permintaan saya:\n\n";
    $message .= "Nama: " . $bookingData['name'] . "\n";
    $message .= "Nomor WhatsApp: " . $bookingData['phone'] . "\n";
    if (!empty($bookingData['email'])) {
        $message .= "Email: " . $bookingData['email'] . "\n";
    }
    $message .= "Unit: " . $bookingData['room'] . "\n";
    $message .= "Check-in: " . formatDate($bookingData['check_in']) . "\n";
    $message .= "Check-out: " . formatDate($bookingData['check_out']) . "\n";
    $message .= "Jumlah Tamu: " . $bookingData['guests'] . "\n";
    $message .= "Durasi Sewa: " . $bookingData['duration'] . " hari\n";
    if (!empty($bookingData['notes'])) {
        $message .= "Permintaan Tambahan: " . $bookingData['notes'] . "\n";
    }
    $message .= "\nMohon informasi mengenai ketersediaan unit dan total biaya penyewaan.\n\n";
    $message .= "Terima kasih.";

    return rawurlencode($message);
}

/**
 * Generate WhatsApp URL
 */
function generateWhatsAppUrl($message) {
    return WHATSAPP_URL . '?text=' . $message;
}

/**
 * Get all room types
 */
function getAllRoomTypes() {
    global $room_types_config;
    return $room_types_config;
}

/**
 * Get room types by category
 */
function getRoomTypesByCategory($type) {
    global $room_types_config;
    return array_filter($room_types_config, function($room) use ($type) {
        return strtolower($room['type']) === strtolower($type);
    });
}

/**
 * Get room type categories
 */
function getRoomTypeCategories() {
    global $room_types_config;
    $types = array_unique(array_column($room_types_config, 'type'));
    return array_values($types);
}

/**
 * Get facilities by category
 */
function getFacilities($category) {
    global $facilities_config;
    return isset($facilities_config[$category]) ? $facilities_config[$category] : [];
}

/**
 * Get all facilities
 */
function getAllFacilities() {
    global $facilities_config;
    return $facilities_config;
}

/**
 * Get all FAQs
 */
function getAllFaqs() {
    global $faq_config;
    return $faq_config;
}

/**
 * Get house rules
 */
function getHouseRules() {
    global $house_rules;
    return $house_rules;
}

/**
 * Get gallery categories
 */
function getGalleryCategories() {
    global $gallery_categories;
    return $gallery_categories;
}

/**
 * Redirect
 */
function redirect($url) {
    header('Location: ' . $url);
    exit;
}

/**
 * Set flash message
 */
function setFlashMessage($type, $message) {
    startSecureSession();
    $_SESSION['flash_message'] = [
        'type' => $type,
        'message' => $message
    ];
}

/**
 * Get flash message
 */
function getFlashMessage() {
    startSecureSession();
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $message;
    }
    return null;
}

/**
 * Get current page URL
 */
function getCurrentUrl() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * Check if current page matches
 */
function isCurrentPage($page) {
    $current = basename($_SERVER['PHP_SELF']);
    return $current === $page;
}

/**
 * Inline SVG icon set (stroke, 24x24). Replaces emoji icons.
 * Usage: echo icon('pin'); or echo renderIcon($facility['icon']);
 */
function icon($name, $size = 22) {
    static $paths = [
        'pin'      => '<path d="M12 21s7-6.2 7-11.5A7 7 0 0 0 5 9.5C5 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>',
        'phone'    => '<rect x="7" y="2.5" width="10" height="19" rx="2"/><path d="M11 18.5h2"/>',
        'camera'   => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r=".6"/>',
        'building' => '<path d="M4 21V4h10v17M14 9h6v12M2 21h20M8 8h2M8 12h2M8 16h2"/>',
        'users'    => '<circle cx="9" cy="8" r="3.2"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6M16 5.2a3.2 3.2 0 0 1 0 5.6M18 14.4c1.8.8 3 2.6 3 5.6"/>',
        'ruler'    => '<path d="M3 17 17 3l4 4L7 21z"/><path d="M7 13l2 2M10 10l2 2M13 7l2 2"/>',
        'bed'      => '<path d="M3 19V6M3 15h18v4M21 15v-3a3 3 0 0 0-3-3h-7v6"/><circle cx="7" cy="11.5" r="1.8"/>',
        'home'     => '<path d="M3 11 12 3l9 8M5 9.5V21h14V9.5M10 21v-6h4v6"/>',
        'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/>',
        'chat'     => '<path d="M4 5h16v11H9l-5 4z"/>',
        'wallet'   => '<path d="M3 7h16a2 2 0 0 1 2 2v10H5a2 2 0 0 1-2-2zM3 7l2-3h12v3"/><circle cx="16.5" cy="13.5" r="1"/>',
        'snow'     => '<path d="M12 2v20M4 7l16 10M20 7 4 17M9 3.5l3 2.5 3-2.5M9 20.5l3-2.5 3 2.5"/>',
        'tv'       => '<rect x="2.5" y="5" width="19" height="13" rx="1.5"/><path d="M8 21h8"/>',
        'wifi'     => '<path d="M2.5 9a14 14 0 0 1 19 0M5.5 12.5a9.5 9.5 0 0 1 13 0M8.5 16a5 5 0 0 1 7 0"/><circle cx="12" cy="19.2" r=".8"/>',
        'play'     => '<rect x="2.5" y="5" width="19" height="14" rx="3"/><path d="m10 9 5 3-5 3z"/>',
        'film'     => '<rect x="3" y="4" width="18" height="16" rx="1.5"/><path d="M7 4v16M17 4v16M3 9h4M3 15h4M17 9h4M17 15h4"/>',
        'utensils' => '<path d="M6 3v7a2 2 0 0 0 4 0V3M8 3v18M17 3c-2 2-3 5-3 8h3v10"/>',
        'shower'   => '<path d="M5 20V8a4 4 0 0 1 7-2.6M9 9l5 5M13 5l6 6-3 3"/><path d="M8 17v1M11 17v2M14 17v1"/>',
        'fridge'   => '<rect x="5" y="2.5" width="14" height="19" rx="2"/><path d="M5 11h14M9 6v2M9 14v3"/>',
        'flame'    => '<path d="M12 21c4 0 6.5-2.6 6.5-6 0-3-2-5-3.5-7-.5 2-1.5 3-3 3 .5-3-.5-6-3-8C8.5 8 5.5 10.5 5.5 15c0 3.4 2.5 6 6.5 6z"/>',
        'shirt'    => '<path d="m8 3-5 3 2.5 4L8 9v12h8V9l2.5 1L21 6l-5-3c-.5 1.5-2 2.5-4 2.5S8.5 4.5 8 3z"/>',
        'lock'     => '<rect x="4.5" y="10.5" width="15" height="10.5" rx="2"/><path d="M8 10.5V7.5a4 4 0 0 1 8 0v3"/>',
        'car'      => '<path d="M4 16V12l2-5h12l2 5v4M3 16h18v3H3zM7 13h.01M17 13h.01"/>',
        'elevator' => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M12 3v18M8.5 9 7 7.5 5.5 9M8.5 15 7 16.5 5.5 15M17 7.5l1.5 1.5M17 7.5 15.5 9"/>',
        'video'    => '<rect x="3" y="6" width="13" height="12" rx="2"/><path d="m16 10.5 5-3v9l-5-3"/>',
        'waves'    => '<path d="M3 8c2 0 2-1.5 4.5-1.5S10 8 12 8s2-1.5 4.5-1.5S19 8 21 8M3 13c2 0 2-1.5 4.5-1.5S10 13 12 13s2-1.5 4.5-1.5S19 13 21 13M3 18c2 0 2-1.5 4.5-1.5S10 18 12 18s2-1.5 4.5-1.5S19 18 21 18"/>',
        'dumbbell' => '<path d="M6 7v10M18 7v10M3 9.5v5M21 9.5v5M6 12h12"/>',
        'tree'     => '<path d="M12 21v-6M12 3c4 0 7 3 7 6.5S16 15 12 15 5 13 5 9.5 8 3 12 3z"/>',
        'cart'     => '<path d="M3 4h2.5l2.2 11h10.1l2-8H6.5"/><circle cx="9" cy="19.5" r="1.2"/><circle cx="17" cy="19.5" r="1.2"/>',
        'hospital' => '<rect x="4" y="4" width="16" height="17" rx="2"/><path d="M12 8.5v7M8.5 12h7"/>',
        'grad'     => '<path d="m2 9 10-5 10 5-10 5zM6 11.5V16c0 1.5 3 3 6 3s6-1.5 6-3v-4.5"/>',
        'bus'      => '<rect x="4" y="3" width="16" height="15" rx="2"/><path d="M4 12h16M8 21v-3M16 21v-3M8 15.5h.01M16 15.5h.01"/>',
        'dot'      => '<circle cx="12" cy="12" r="3"/>',
        'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'whatsapp' => '<path d="M3.5 20.5 5 16A8.5 8.5 0 1 1 8 19z"/><path d="M9 8.8c0 3.2 3 6.2 6.2 6.2l1.3-1.3-2-1-.9.7c-.9-.4-1.8-1.3-2.2-2.2l.7-.9-1-2z"/>',
    ];
    $inner = isset($paths[$name]) ? $paths[$name] : $paths['dot'];
    return '<svg class="icon icon-' . $name . '" width="' . (int)$size . '" height="' . (int)$size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $inner . '</svg>';
}

/**
 * Map legacy emoji (stored in config/business.php) to SVG icons.
 */
function renderIcon($emoji, $size = 22) {
    static $map = [
        "\u{2744}" => 'snow', "\u{1F4FA}" => 'tv', "\u{1F4F6}" => 'wifi', "\u{25B6}" => 'play',
        "\u{1F3AC}" => 'film', "\u{1F373}" => 'utensils', "\u{1F6BF}" => 'shower', "\u{1F9CA}" => 'fridge',
        "\u{1F525}" => 'flame', "\u{1F455}" => 'shirt', "\u{1F512}" => 'lock', "\u{1F697}" => 'car',
        "\u{1F6D7}" => 'elevator', "\u{1F4F9}" => 'video', "\u{1F3CA}" => 'waves', "\u{1F4AA}" => 'dumbbell',
        "\u{1F333}" => 'tree', "\u{1F3E2}" => 'building', "\u{1F6D2}" => 'cart', "\u{1F37D}" => 'utensils',
        "\u{1F3E5}" => 'hospital', "\u{1F393}" => 'grad', "\u{1F68C}" => 'bus',
    ];
    $key = preg_replace('/[\x{FE0F}\x{200D}]/u', '', (string)$emoji);
    return icon(isset($map[$key]) ? $map[$key] : 'dot', $size);
}

