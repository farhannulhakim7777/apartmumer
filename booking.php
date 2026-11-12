<?php
/**
 * Mumer Room - Booking Processing
 * Handles booking form submission and redirects to WhatsApp
 */

if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

require_once APP_ROOT . '/config/constants.php';
require_once APP_ROOT . '/config/business.php';
require_once APP_ROOT . '/includes/functions.php';
require_once INCLUDES_PATH . '/security.php';

// Send security headers
sendSecurityHeaders();

// Start session
startSecureSession();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(baseUrl('rooms.php'));
}

// Validate CSRF token
if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
    setFlashMessage('error', 'Permintaan tidak valid. Silakan coba lagi.');
    redirect(baseUrl('rooms.php'));
}

// Rate limiting
if (!checkRateLimit($_SERVER['REMOTE_ADDR'], 10, 60)) {
    setFlashMessage('error', 'Terlalu banyak permintaan. Silakan coba lagi beberapa saat lagi.');
    redirect(baseUrl('rooms.php'));
}

// Sanitize and validate input
$name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
$phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
$email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
$room = isset($_POST['room']) ? sanitizeInput($_POST['room']) : '';
$checkIn = isset($_POST['check_in']) ? sanitizeInput($_POST['check_in']) : '';
$checkOut = isset($_POST['check_out']) ? sanitizeInput($_POST['check_out']) : '';
$guests = isset($_POST['guests']) ? intval($_POST['guests']) : 0;
$notes = isset($_POST['notes']) ? sanitizeInput($_POST['notes']) : '';

// Validation errors
$errors = [];

// Validate name
if (empty($name)) {
    $errors[] = 'Nama wajib diisi';
}

// Validate phone
if (empty($phone)) {
    $errors[] = 'Nomor WhatsApp wajib diisi';
} elseif (!validatePhone($phone)) {
    $errors[] = 'Silakan masukkan nomor telepon yang valid';
}

// Validate email if provided
if (!empty($email) && !validateEmail($email)) {
    $errors[] = 'Silakan masukkan alamat email yang valid';
}

// Validate room
if (empty($room)) {
    $errors[] = 'Silakan pilih kamar';
}

// Validate dates
if (empty($checkIn)) {
    $errors[] = 'Tanggal check-in wajib diisi';
} elseif (!validateDate($checkIn, 'Y-m-d')) {
    $errors[] = 'Format tanggal check-in tidak valid';
} elseif (!isFutureDate($checkIn)) {
    $errors[] = 'Tanggal check-in harus setelah hari ini';
}

if (empty($checkOut)) {
    $errors[] = 'Tanggal check-out wajib diisi';
} elseif (!validateDate($checkOut, 'Y-m-d')) {
    $errors[] = 'Format tanggal check-out tidak valid';
}

// Validate date range
if (!empty($checkIn) && !empty($checkOut) && validateDate($checkIn, 'Y-m-d') && validateDate($checkOut, 'Y-m-d')) {
    if (!isValidDateRange($checkIn, $checkOut)) {
        $errors[] = 'Tanggal check-out harus setelah tanggal check-in';
    }
}

// Validate guests
if ($guests < 1 || $guests > MAX_GUESTS_PER_ROOM) {
    $errors[] = 'Jumlah tamu tidak valid';
}

// If there are errors, redirect back with flash message
if (!empty($errors)) {
    setFlashMessage('error', implode('<br>', $errors));
    redirect(baseUrl('rooms.php'));
}

// Calculate duration
$duration = calculateDuration($checkIn, $checkOut);

// Prepare booking data
$bookingData = [
    'name' => $name,
    'phone' => $phone,
    'email' => $email,
    'room' => $room,
    'check_in' => $checkIn,
    'check_out' => $checkOut,
    'guests' => $guests,
    'duration' => $duration,
    'notes' => $notes
];

// Generate WhatsApp message
$whatsappMessage = generateWhatsAppMessage($bookingData);

// Generate WhatsApp URL
$whatsappUrl = generateWhatsAppUrl($whatsappMessage);

// Redirect to WhatsApp
header('Location: ' . $whatsappUrl);
exit;
