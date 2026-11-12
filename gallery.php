<?php
/**
 * Mumer Room - Gallery Page
 */

if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

require_once APP_ROOT . '/config/constants.php';
require_once APP_ROOT . '/config/business.php';
require_once APP_ROOT . '/includes/functions.php';

$pageTitle = 'Galeri';
$pageDescription = 'Lihat galeri foto kamar apartemen Mumer Room di Paragon Village Karawaci.';

require_once INCLUDES_PATH . '/header.php';

// Daftar seluruh foto kamar apartemen tanpa filter atau kategori
$galleryImages = [
    'rooms/kamar1.jpeg',
    'rooms/kamar2.jpeg',
    'rooms/kamar4.jpeg',
    'rooms/kamar5.jpeg',
    'rooms/kamar6.jpeg',
    'rooms/kamar7.jpeg',
    'rooms/kamar8.jpeg',
    'rooms/kamar9.jpeg',
    'rooms/kamar10.jpeg',
    'rooms/kamar11.jpeg',
    'rooms/kamar12.jpeg',
    'rooms/kamar13.jpeg',
    'gallery/kamar55.jpeg',
    'gallery/kamar66.jpeg',
    'gallery/campuran1.jpeg',
    'gallery/apart1.jpeg',
    'gallery/apart2.jpeg'
];
?>

<!-- Breadcrumbs -->
<div class="container">
    <div class="breadcrumbs">
        <a href="<?php echo baseUrl('index.php'); ?>">Beranda</a>
        <span class="breadcrumbs-separator">/</span>
        <span>Galeri</span>
    </div>
</div>

<!-- Page Header -->
<section class="section section-surface">
    <div class="container">
        <div class="section-header">
            <p class="eyebrow">Galeri</p>
            <h1 class="section-title">Galeri Foto</h1>
            <p class="section-subtitle">Dokumentasi foto kamar dan suasana unit apartemen kami</p>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="section">
    <div class="container">
        <div class="gallery-masonry">
            <?php foreach ($galleryImages as $index => $imagePath): ?>
                <div class="gallery-item animate-on-scroll">
                    <img src="<?php echo imageUrl($imagePath); ?>" alt="Foto Kamar Mumer Room" loading="lazy">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
    <button class="lightbox-close" id="lightboxClose">&times;</button>
    <button class="lightbox-nav lightbox-prev" id="lightboxPrev">&#10094;</button>
    <img src="" alt="Foto Galeri" class="lightbox-image" id="lightboxImage">
    <button class="lightbox-nav lightbox-next" id="lightboxNext">&#10095;</button>
</div>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Tertarik Menginap?</h2>
        <p>Tanyakan ketersediaan unit sekarang langsung melalui WhatsApp</p>
        <a href="<?php echo baseUrl('rooms.php'); ?>" class="btn btn-lg">Lihat Tipe Unit</a>
    </div>
</section>

<?php require_once INCLUDES_PATH . '/footer.php'; ?>
