<?php
/**
 * Mumer Room - Halaman Utama
 */

// Define APP_ROOT if not already defined
if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

require_once APP_ROOT . '/config/constants.php';
require_once APP_ROOT . '/config/business.php';
require_once APP_ROOT . '/includes/functions.php';

$pageTitle = 'Beranda';
$pageDescription = 'Temukan hunian apartemen nyaman di Paragon Village Karawaci bersama Mumer Room. Kenyamanan Anda, Pilihan Anda.';

require_once INCLUDES_PATH . '/header.php';

$roomTypes = getAllRoomTypes();
$featuredTypes = array_slice($roomTypes, 0, 3);
$allFacilities = getAllFacilities();
$inRoomFacilities = array_slice($allFacilities['in_room'], 0, 8);
?>

<!-- Hero Section — Full-width apartment image -->
<section class="hero hero-fullbg">
    <div class="hero-bg-overlay"></div>
    <div class="container hero-fullbg-inner">
        <div class="hero-content animate-on-scroll">
            <p class="eyebrow"><?php echo htmlspecialchars(PROPERTY_NAME); ?></p>
            <h1 class="hero-title"><?php echo htmlspecialchars(BUSINESS_TAGLINE); ?></h1>
            <p class="hero-subtitle">Temukan hunian apartemen nyaman di <?php echo htmlspecialchars(PROPERTY_NAME); ?> bersama <?php echo htmlspecialchars(BUSINESS_NAME); ?>.</p>
            <div class="hero-cta animate-on-scroll">
                <a href="<?php echo baseUrl('rooms.php'); ?>" class="btn btn-primary btn-lg">Lihat Tipe Unit <?php echo icon('arrow', 18); ?></a>
                <a href="<?php echo baseUrl('contact.php'); ?>" class="link-arrow">Hubungi Kami</a>
            </div>
        </div>
        <div class="hero-thumbs animate-on-scroll">
            <figure class="hero-thumb hero-thumb-1">
                <img src="<?php echo imageUrl('gallery/apart2.jpeg'); ?>" alt="Eksterior <?php echo htmlspecialchars(PROPERTY_NAME); ?>" loading="lazy">
                <figcaption>Eksterior</figcaption>
            </figure>
            <figure class="hero-thumb hero-thumb-2">
                <img src="<?php echo imageUrl('rooms/kamar1.jpeg'); ?>" alt="Interior Kamar" loading="lazy">
                <figcaption>Interior Kamar</figcaption>
            </figure>
        </div>
    </div>
    <p class="hero-caption"><span>Harian</span><span>Mingguan</span><span>Bulanan</span></p>
</section>

<!-- Quick Inquiry Section -->
<section class="quick-booking">
    <div class="container">
        <h2 class="quick-booking-title">Tanya Cepat</h2>
        <form class="quick-booking-form" action="<?php echo WHATSAPP_URL; ?>" method="GET" target="_blank" onsubmit="sendQuickInquiry(event)">
            <div class="form-group">
                <label for="qb_type">Tipe Unit</label>
                <select id="qb_type" name="unit_type">
                    <option value="">Pilih tipe</option>
                    <?php foreach ($roomTypes as $type): ?>
                        <option value="<?php echo htmlspecialchars($type['name']); ?>"><?php echo htmlspecialchars($type['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="qb_check_in">Check-in</label>
                <input type="date" id="qb_check_in" name="check_in" min="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <label for="qb_duration">Durasi</label>
                <select id="qb_duration" name="duration">
                    <option value="">Pilih</option>
                    <option value="Harian">Harian</option>
                    <option value="Mingguan">Mingguan</option>
                    <option value="Bulanan">Bulanan</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tanya via WhatsApp</button>
        </form>
    </div>
</section>

<script>
function sendQuickInquiry(event) {
    event.preventDefault();

    const unitType = document.getElementById('qb_type').value;
    const checkIn = document.getElementById('qb_check_in').value;
    const duration = document.getElementById('qb_duration').value;

    let message = `Halo Mumer Room, saya ingin menanyakan ketersediaan unit.`;
    if (unitType) message += `\nTipe Unit: ${unitType}`;
    if (checkIn) message += `\nCheck-in: ${checkIn}`;
    if (duration) message += `\nDurasi: ${duration}`;
    message += `\n\nMohon informasi harga dan ketersediaan.`;

    const url = '<?php echo WHATSAPP_URL; ?>?text=' + encodeURIComponent(message);
    window.open(url, '_blank');
}
</script>

<!-- About Section -->
<section class="section about-section">
    <div class="container">
        <div class="about-content">
            <div class="about-text animate-on-scroll">
                <h2>Selamat Datang di <?php echo htmlspecialchars(BUSINESS_NAME); ?></h2>
                <p>
                    <?php echo htmlspecialchars(BUSINESS_NAME); ?> adalah pilihan terbaik untuk penyewaan apartemen yang nyaman dan terjangkau di <?php echo htmlspecialchars(PROPERTY_NAME); ?>, Karawaci, Tangerang.
                </p>
                <p>
                    Kami menawarkan apartemen yang terawat dan fully-furnished, dirancang untuk memberikan pengalaman tinggal layaknya di rumah sendiri. Baik untuk perjalanan bisnis, liburan, maupun hunian jangka panjang, unit kami dilengkapi fasilitas modern demi kenyamanan Anda.
                </p>
                <p>
                    Berlokasi strategis dengan akses mudah ke pusat perbelanjaan, restoran, dan transportasi umum, <?php echo htmlspecialchars(BUSINESS_NAME); ?> memadukan kemudahan dengan kualitas hunian.
                </p>
                <a href="<?php echo baseUrl('contact.php'); ?>" class="btn btn-primary">Pelajari Lebih Lanjut</a>
            </div>
            <div class="about-image animate-on-scroll">
                <img src="<?php echo imageUrl('gallery/apart1.jpeg'); ?>" alt="Gedung <?php echo htmlspecialchars(PROPERTY_NAME); ?>" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- Featured Room Types -->
<section class="section featured-rooms">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <p class="eyebrow">Tipe Unit</p>
            <h2 class="section-title">Tipe Unit Tersedia</h2>
            <p class="section-subtitle">Jelajahi tipe unit apartemen kami yang tersedia</p>
        </div>

        <div class="rooms-grid">
            <?php foreach ($featuredTypes as $type): ?>
                <div class="room-card animate-on-scroll">
                    <div class="room-image">
                        <img src="<?php echo imageUrl('rooms/' . $type['image']); ?>" alt="<?php echo htmlspecialchars($type['name']); ?>" loading="lazy">
                        <span class="badge-example">Foto Contoh</span>
                    </div>
                    <div class="room-content">
                        <div class="room-type"><?php echo htmlspecialchars($type['type']); ?></div>
                        <h3 class="room-name"><?php echo htmlspecialchars($type['name']); ?></h3>
                        <div class="room-details">
                            <div class="room-detail-item">
                                <span class="icon-wrap"><?php echo icon('users', 16); ?></span>
                                <span><?php echo $type['capacity']; ?> Tamu</span>
                            </div>
                            <div class="room-detail-item">
                                <span class="icon-wrap"><?php echo icon('ruler', 16); ?></span>
                                <span><?php echo htmlspecialchars($type['size']); ?></span>
                            </div>
                        </div>
                        <p class="room-excerpt">
                            <?php echo htmlspecialchars(truncateText($type['description'], 80)); ?>
                        </p>
                        <div class="room-price">
                            <?php echo htmlspecialchars($type['price_note']); ?>
                        </div>
                        <div class="room-actions">
                            <a href="<?php echo baseUrl('room-detail.php?id=' . $type['id']); ?>" class="btn btn-outline">Lihat Detail</a>
                            <a href="<?php echo WHATSAPP_URL; ?>?text=<?php echo rawurlencode('Halo Mumer Room, saya ingin bertanya mengenai ketersediaan unit tipe ' . $type['name']); ?>" target="_blank" class="btn btn-primary">Tanya Sekarang</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="section-cta">
            <a href="<?php echo baseUrl('rooms.php'); ?>" class="btn btn-primary btn-lg">Lihat Semua Tipe Unit</a>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section why-choose">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <p class="eyebrow">Mengapa Kami</p>
            <h2 class="section-title">Mengapa Memilih <?php echo htmlspecialchars(BUSINESS_NAME); ?>?</h2>
            <p class="section-subtitle">Rasakan perbedaan dengan layanan dan fasilitas premium kami</p>
        </div>

        <div class="features-grid">
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon"><?php echo icon('home'); ?></div>
                <h3 class="feature-title">Hunian Nyaman</h3>
                <p class="feature-description">Apartemen terawat dengan fasilitas modern untuk kenyamanan Anda</p>
            </div>
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon"><?php echo icon('pin'); ?></div>
                <h3 class="feature-title">Lokasi Strategis</h3>
                <p class="feature-description">Lokasi strategis dekat pusat perbelanjaan, restoran, dan transportasi</p>
            </div>
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon"><?php echo icon('calendar'); ?></div>
                <h3 class="feature-title">Sewa Fleksibel</h3>
                <p class="feature-description">Pilihan sewa harian, mingguan, dan bulanan sesuai kebutuhan Anda</p>
            </div>
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon"><?php echo icon('phone'); ?></div>
                <h3 class="feature-title">Pemesanan Mudah</h3>
                <p class="feature-description">Proses pemesanan sederhana dengan konfirmasi langsung via WhatsApp</p>
            </div>
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon"><?php echo icon('chat'); ?></div>
                <h3 class="feature-title">Layanan Responsif</h3>
                <p class="feature-description">Customer service siap membantu Anda kapan saja</p>
            </div>
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon"><?php echo icon('wallet'); ?></div>
                <h3 class="feature-title">Harga Terjangkau</h3>
                <p class="feature-description">Harga kompetitif tanpa mengorbankan kualitas hunian</p>
            </div>
        </div>
    </div>
</section>

<!-- Facilities Preview -->
<section class="section facilities-preview">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <p class="eyebrow">Fasilitas</p>
            <h2 class="section-title">Fasilitas Kami</h2>
            <p class="section-subtitle">Semua yang Anda butuhkan untuk hunian yang nyaman</p>
        </div>

        <div class="facilities-list">
            <?php foreach ($inRoomFacilities as $facility): ?>
                <div class="facility-item animate-on-scroll">
                    <div class="facility-item-icon"><?php echo renderIcon($facility['icon']); ?></div>
                    <div class="facility-item-name"><?php echo htmlspecialchars($facility['name']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="section-cta">
            <a href="<?php echo baseUrl('facilities.php'); ?>" class="btn btn-outline btn-lg">Lihat Semua Fasilitas</a>
        </div>
    </div>
</section>

<!-- Gallery Preview -->
<section class="section gallery-preview">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <p class="eyebrow">Galeri</p>
            <h2 class="section-title">Galeri Foto</h2>
            <p class="section-subtitle">Lihat langsung suasana apartemen kami</p>
        </div>

        <div class="gallery-grid">
            <div class="gallery-item animate-on-scroll">
                <img src="<?php echo imageUrl('rooms/kamar1.jpeg'); ?>" alt="Interior Apartemen" loading="lazy">
            </div>
            <div class="gallery-item animate-on-scroll">
                <img src="<?php echo imageUrl('rooms/kamar2.jpeg'); ?>" alt="Ruang Tamu" loading="lazy">
            </div>
            <div class="gallery-item animate-on-scroll">
                <img src="<?php echo imageUrl('rooms/kamar4.jpeg'); ?>" alt="Kamar Tidur" loading="lazy">
            </div>
            <div class="gallery-item animate-on-scroll">
                <img src="<?php echo imageUrl('rooms/kamar5.jpeg'); ?>" alt="Dapur" loading="lazy">
            </div>
            <div class="gallery-item animate-on-scroll">
                <img src="<?php echo imageUrl('gallery/apart1.jpeg'); ?>" alt="Eksterior Gedung" loading="lazy">
            </div>
        </div>

        <div class="section-cta">
            <a href="<?php echo baseUrl('gallery.php'); ?>" class="btn btn-primary btn-lg">Lihat Galeri Lengkap</a>
        </div>
    </div>
</section>

<!-- Location Preview -->
<section class="section">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <p class="eyebrow">Lokasi</p>
            <h2 class="section-title">Lokasi Kami</h2>
            <p class="section-subtitle">Berlokasi strategis di Karawaci, Tangerang</p>
        </div>

        <div class="address-panel">
            <p class="address-line">
                <?php echo icon('pin', 20); ?> <?php echo htmlspecialchars(FULL_ADDRESS); ?>
            </p>
            <a href="<?php echo GOOGLE_MAPS_URL; ?>" target="_blank" class="btn btn-primary btn-lg">Buka di Google Maps</a>
        </div>

        <div class="section-cta">
            <a href="<?php echo baseUrl('location.php'); ?>" class="btn btn-outline btn-lg">Info Lokasi Lengkap</a>
        </div>
    </div>
</section>

<!-- FAQ Preview -->
<section class="section section-surface">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <p class="eyebrow">FAQ</p>
            <h2 class="section-title">Pertanyaan Umum</h2>
            <p class="section-subtitle">Temukan jawaban atas pertanyaan yang sering ditanyakan</p>
        </div>

        <div class="faq-section">
            <?php
            $faqs = getAllFaqs();
            $previewFaqs = array_slice($faqs, 0, 3);
            foreach ($previewFaqs as $index => $faq):
            ?>
                <div class="faq-item animate-on-scroll">
                    <button class="faq-question" onclick="toggleFaq(<?php echo $index; ?>)">
                        <?php echo htmlspecialchars($faq['question']); ?>
                    </button>
                    <div class="faq-answer" id="faq-<?php echo $index; ?>">
                        <div class="faq-answer-content">
                            <?php echo htmlspecialchars($faq['answer']); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="section-cta">
            <a href="<?php echo baseUrl('faq.php'); ?>" class="btn btn-outline btn-lg">Lihat Semua FAQ</a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Tertarik dengan Unit Kami?</h2>
        <p>Hubungi kami sekarang untuk informasi ketersediaan dan harga di <?php echo htmlspecialchars(PROPERTY_NAME); ?></p>
        <a href="<?php echo baseUrl('rooms.php'); ?>" class="btn btn-lg">Lihat Tipe Unit <?php echo icon('arrow', 18); ?></a>
    </div>
</section>

<script>
function toggleFaq(index) {
    const faqItem = document.querySelector(`.faq-item:nth-child(${index + 1})`);
    faqItem.classList.toggle('active');
}
</script>

<?php require_once INCLUDES_PATH . '/footer.php'; ?>
