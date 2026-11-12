<?php
/**
 * Mumer Room - Security Functions
 * CSRF protection, input validation, output escaping
 */

// Prevent direct access
if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__));
}

require_once CONFIG_PATH . '/constants.php';

/**
 * Start secure session
 */
function startSecureSession() {
    if (session_status() === PHP_SESSION_NONE) {
        ini_set('session.cookie_httponly', 1);
        ini_set('session.cookie_secure', 1);
        ini_set('session.use_strict_mode', 1);
        ini_set('session.cookie_samesite', 'Strict');
        session_name(SESSION_NAME);
        session_start();
    }
}

/**
 * Generate CSRF token
 */
function generateCsrfToken() {
    startSecureSession();
    if (empty($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }
    return $_SESSION[CSRF_TOKEN_NAME];
}

/**
 * Validate CSRF token
 */
function validateCsrfToken($token) {
    startSecureSession();
    return isset($_SESSION[CSRF_TOKEN_NAME]) && hash_equals($_SESSION[CSRF_TOKEN_NAME], $token);
}

/**
 * Sanitize input string
 */
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate email
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate phone number (Indonesia format)
 */
function validatePhone($phone) {
    // Remove spaces, dashes, and parentheses
    $phone = preg_replace('/[\s\-\(\)]/', '', $phone);
    // Check if starts with +62 or 62 or 0
    return preg_match('/^(\+62|62|0)[0-9]{9,13}$/', $phone);
}

/**
 * Validate date
 */
function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

/**
 * Check if date is in the future
 */
function isFutureDate($date) {
    $today = new DateTime();
    $checkDate = new DateTime($date);
    return $checkDate > $today;
}

/**
 * Check if check-out is after check-in
 */
function isValidDateRange($checkIn, $checkOut) {
    $in = new DateTime($checkIn);
    $out = new DateTime($checkOut);
    return $out > $in;
}

/**
 * Calculate duration in days
 */
function calculateDuration($checkIn, $checkOut) {
    $in = new DateTime($checkIn);
    $out = new DateTime($checkOut);
    return $out->diff($in)->days;
}

/**
 * Send security headers
 */
function sendSecurityHeaders() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
}

/**
 * Rate limiting (simple implementation)
 */
function checkRateLimit($identifier, $maxRequests = 10, $timeWindow = 60) {
    startSecureSession();
    $key = 'rate_limit_' . md5($identifier);
    $now = time();

    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = ['count' => 0, 'time' => $now];
    }

    $data = $_SESSION[$key];

    // Reset if time window passed
    if ($now - $data['time'] > $timeWindow) {
        $_SESSION[$key] = ['count' => 1, 'time' => $now];
        return true;
    }

    // Check limit
    if ($data['count'] >= $maxRequests) {
        return false;
    }

    $_SESSION[$key]['count']++;
    return true;
}
