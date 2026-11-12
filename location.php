<?php
/**
 * Mumer Room - Halaman Lokasi
 */

if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

require_once APP_ROOT . '/config/constants.php';
require_once APP_ROOT . '/config/business.php';
require_once APP_ROOT . '/includes/functions.php';

$pageTitle = 'Lokasi';
$pageDescription = 'Temukan kami di Paragon Village Karawaci, Tangerang. Lokasi strategis dengan akses mudah ke berbagai fasilitas.';

require_once INCLUDES_PATH . '/header.php';
?>

<!-- Breadcrumbs -->
<div class="container">
    <div class="breadcrumbs">
        <a href="<?php echo baseUrl('index.php'); ?>">Beranda</a>
        <span class="breadcrumbs-separator">/</span>
        <span>Lokasi</span>
    </div>
</div>

<!-- Page Header -->
<section class="section section-surface">
    <div class="container">
        <div class="section-header">
            <p class="eyebrow">Lokasi</p>
            <h1 class="section-title">Lokasi Kami</h1>
            <p class="section-subtitle">Berlokasi strategis di Karawaci, Tangerang</p>
        </div>
    </div>
</section>

<!-- Location Content -->
<section class="section">
    <div class="container">
        <div class="location-content">
            <div class="location-info">
                <h2>Alamat</h2>
                <p class="location-address">
                    <?php echo htmlspecialchars(FULL_ADDRESS); ?>
                </p>

                <div class="location-nearby">
                    <h3>Fasilitas Sekitar</h3>
                    <ul>
                        <li>Pusat Perbelanjaan — Supermal Karawaci, Benton Junction</li>
                        <li>Restoran — Berbagai pilihan kuliner lokal dan internasional</li>
                        <li>Rumah Sakit — Siloam Hospitals Karawaci</li>
                        <li>Universitas — UPH, BINUS University</li>
                        <li>Transportasi Umum — Halte bus, akses tol</li>
                    </ul>
                </div>

                <div class="location-nearby">
                    <h3>Informasi Transportasi</h3>
                    <ul>
                        <li>Akses mudah ke tol Jakarta–Tangerang</li>
                        <li>Transportasi umum tersedia di sekitar lokasi</li>
                        <li>Layanan Grab dan Gojek mudah ditemukan</li>
                        <li>Sekitar 45 menit ke pusat kota Jakarta</li>
                    </ul>
                </div>

                <div class="location-nearby">
                    <h3>Dari Bandara</h3>
                    <ul>
                        <li>Bandara Internasional Soekarno-Hatta: Sekitar 45 menit dengan kendaraan</li>
                        <li>Bandara Halim Perdanakusuma: Sekitar 1 jam dengan kendaraan</li>
                    </ul>
                </div>

                <div class="stack-top">
                    <a href="<?php echo GOOGLE_MAPS_URL; ?>" target="_blank" class="btn btn-primary btn-lg">Buka di Google Maps</a>
                </div>
            </div>

            <div class="location-map">
                <div class="location-map-placeholder">
                    <p class="map-pin"><?php echo icon('pin', 34); ?></p>
                    <p>Klik tombol di bawah untuk melihat lokasi kami di Google Maps</p>
                    <a href="<?php echo GOOGLE_MAPS_URL; ?>" target="_blank" class="btn btn-outline">Buka Google Maps</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Butuh Petunjuk Arah?</h2>
        <p>Hubungi kami via WhatsApp jika Anda membutuhkan bantuan menemukan lokasi kami</p>
        <a href="<?php echo WHATSAPP_URL; ?>?text=<?php echo rawurlencode('Halo Mumer Room, saya butuh bantuan arahan menuju lokasi.'); ?>" target="_blank" class="btn btn-lg">Chat di WhatsApp</a>
    </div>
</section>

<?php require_once INCLUDES_PATH . '/footer.php'; ?>
