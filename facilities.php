<?php
/**
 * Mumer Room - Facilities Page
 */

if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

require_once APP_ROOT . '/config/constants.php';
require_once APP_ROOT . '/config/business.php';
require_once APP_ROOT . '/includes/functions.php';

$pageTitle = 'Fasilitas';
$pageDescription = 'Jelajahi fasilitas yang tersedia di apartemen Mumer Room, Paragon Village Karawaci.';

require_once INCLUDES_PATH . '/header.php';

$allFacilities = getAllFacilities();
?>

<!-- Breadcrumbs -->
<div class="container">
    <div class="breadcrumbs">
        <a href="<?php echo baseUrl('index.php'); ?>">Beranda</a>
        <span class="breadcrumbs-separator">/</span>
        <span>Fasilitas</span>
    </div>
</div>

<!-- Page Header -->
<section class="section section-surface">
    <div class="container">
        <div class="section-header">
            <p class="eyebrow">Fasilitas</p>
            <h1 class="section-title">Fasilitas Kami</h1>
            <p class="section-subtitle">Semua yang Anda butuhkan untuk hunian yang nyaman dan praktis</p>
        </div>
    </div>
</section>

<!-- In-Room Facilities -->
<section class="section">
    <div class="container">
        <div class="facilities-section">
            <h2>Fasilitas Dalam Unit</h2>
            <p class="lead-note">
                Setiap unit apartemen dilengkapi fasilitas modern untuk memastikan kenyamanan Anda selama menginap.
            </p>
            <div class="facilities-grid">
                <?php foreach ($allFacilities['in_room'] as $facility): ?>
                    <div class="facility-card animate-on-scroll">
                        <div class="facility-card-icon"><?php echo renderIcon($facility['icon']); ?></div>
                        <h3 class="facility-card-name"><?php echo htmlspecialchars($facility['name']); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Building Facilities -->
<section class="section section-surface">
    <div class="container">
        <div class="facilities-section">
            <h2>Fasilitas Gedung</h2>
            <p class="lead-note">
                Nikmati fasilitas yang tersedia di gedung Paragon Village untuk seluruh penghuni.
            </p>
            <div class="facilities-grid">
                <?php foreach ($allFacilities['building'] as $facility): ?>
                    <div class="facility-card animate-on-scroll">
                        <div class="facility-card-icon"><?php echo renderIcon($facility['icon']); ?></div>
                        <h3 class="facility-card-name"><?php echo htmlspecialchars($facility['name']); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Shared Facilities -->
<section class="section">
    <div class="container">
        <div class="facilities-section">
            <h2>Fasilitas Bersama</h2>
            <p class="lead-note">
                Akses ke area rekreasi bersama di dalam kompleks apartemen.
            </p>
            <div class="facilities-grid">
                <?php foreach ($allFacilities['shared'] as $facility): ?>
                    <div class="facility-card animate-on-scroll">
                        <div class="facility-card-icon"><?php echo renderIcon($facility['icon']); ?></div>
                        <h3 class="facility-card-name"><?php echo htmlspecialchars($facility['name']); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Nearby Facilities -->
<section class="section section-surface">
    <div class="container">
        <div class="facilities-section">
            <h2>Fasilitas Sekitar</h2>
            <p class="lead-note">
                Akses mudah ke layanan penting dan tempat hiburan di sekitar lokasi.
            </p>
            <div class="facilities-grid">
                <?php foreach ($allFacilities['nearby'] as $facility): ?>
                    <div class="facility-card animate-on-scroll">
                        <div class="facility-card-icon"><?php echo renderIcon($facility['icon']); ?></div>
                        <h3 class="facility-card-name"><?php echo htmlspecialchars($facility['name']); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ada Pertanyaan Tentang Fasilitas Kami?</h2>
        <p>Hubungi kami untuk informasi lebih lanjut tentang apa yang kami tawarkan</p>
        <a href="<?php echo WHATSAPP_URL; ?>?text=<?php echo rawurlencode('Halo Mumer Room, saya ingin bertanya mengenai fasilitas.'); ?>" target="_blank" class="btn btn-lg">Chat di WhatsApp</a>
    </div>
</section>

<?php require_once INCLUDES_PATH . '/footer.php'; ?>
