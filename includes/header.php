<?php
/**
 * Mumer Room - Header Component
 */

// Prevent direct access
if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__));
}

require_once CONFIG_PATH . '/constants.php';
require_once CONFIG_PATH . '/business.php';
require_once INCLUDES_PATH . '/security.php';

// Send security headers
sendSecurityHeaders();

// Start session if needed
startSecureSession();

$pageTitle = isset($pageTitle) ? $pageTitle . ' - ' . BUSINESS_NAME : SITE_TITLE;
$pageDescription = isset($pageDescription) ? $pageDescription : SITE_DESCRIPTION;
$pageKeywords = isset($pageKeywords) ? $pageKeywords : SITE_KEYWORDS;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#080808">
    <meta name="color-scheme" content="dark">

    <!-- SEO Meta Tags -->
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($pageKeywords); ?>">
    <meta name="author" content="<?php echo htmlspecialchars(BUSINESS_NAME); ?>">
    <link rel="canonical" href="<?php echo htmlspecialchars(getCurrentUrl()); ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars(getCurrentUrl()); ?>">
    <meta property="og:site_name" content="<?php echo htmlspecialchars(BUSINESS_NAME); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo assetUrl('css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo assetUrl('css/components.css'); ?>">
    <link rel="stylesheet" href="<?php echo assetUrl('css/responsive.css'); ?>">

    <noscript><style>.animate-on-scroll{opacity:1!important;transform:none!important}</style></noscript>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="<?php echo imageUrl('logo/logo1.jpeg'); ?>">

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LodgingBusiness",
        "name": "<?php echo htmlspecialchars(BUSINESS_NAME); ?>",
        "description": "<?php echo htmlspecialchars(SITE_DESCRIPTION); ?>",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Jl. Raya Binong No.9a",
            "addressLocality": "Binong",
            "addressRegion": "Banten",
            "postalCode": "15811",
            "addressCountry": "ID"
        },
        "telephone": "<?php echo htmlspecialchars(WHATSAPP_NUMBER); ?>",
        "url": "<?php echo BASE_URL; ?>"
    }
    </script>
</head>
<body>
    <?php require_once INCLUDES_PATH . '/navbar.php'; ?>
    <main>
