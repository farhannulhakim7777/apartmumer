<?php
/**
 * Mumer Room - Contact Page
 */

if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

require_once APP_ROOT . '/config/constants.php';
require_once APP_ROOT . '/config/business.php';
require_once APP_ROOT . '/includes/functions.php';

$pageTitle = 'Kontak';
$pageDescription = 'Hubungi Mumer Room untuk pertanyaan seputar sewa apartemen di Paragon Village Karawaci.';

require_once INCLUDES_PATH . '/header.php';

$csrfToken = generateCsrfToken();
?>

<!-- Breadcrumbs -->
<div class="container">
    <div class="breadcrumbs">
        <a href="<?php echo baseUrl('index.php'); ?>">Beranda</a>
        <span class="breadcrumbs-separator">/</span>
        <span>Kontak</span>
    </div>
</div>

<!-- Page Header -->
<section class="section section-surface">
    <div class="container">
        <div class="section-header">
            <p class="eyebrow">Kontak</p>
            <h1 class="section-title">Hubungi Kami</h1>
            <p class="section-subtitle">Hubungi kami untuk pertanyaan atau pemesanan unit</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Information -->
            <div class="contact-info animate-on-scroll">
                <h2>Informasi Kontak</h2>

                <div class="contact-item">
                    <div class="contact-item-icon"><?php echo icon('pin'); ?></div>
                    <div class="contact-item-content">
                        <h3>Alamat</h3>
                        <p><?php echo htmlspecialchars(FULL_ADDRESS); ?></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-item-icon"><?php echo icon('phone'); ?></div>
                    <div class="contact-item-content">
                        <h3>WhatsApp</h3>
                        <a href="<?php echo WHATSAPP_URL; ?>" target="_blank"><?php echo htmlspecialchars(WHATSAPP_NUMBER); ?></a>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-item-icon"><?php echo icon('camera'); ?></div>
                    <div class="contact-item-content">
                        <h3>Instagram</h3>
                        <a href="<?php echo INSTAGRAM_URL; ?>" target="_blank"><?php echo htmlspecialchars(INSTAGRAM_HANDLE); ?></a>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-item-icon"><?php echo icon('building'); ?></div>
                    <div class="contact-item-content">
                        <h3>Properti</h3>
                        <p><?php echo htmlspecialchars(PROPERTY_NAME); ?></p>
                    </div>
                </div>

                <div class="stack-top">
                    <h3 class="subhead">Ikuti Kami</h3>
                    <div class="footer-social">
                        <a href="<?php echo WHATSAPP_URL; ?>" target="_blank" class="social-link" aria-label="WhatsApp">
                            <svg viewBox="0 0 32 32" class="social-icon">
                                <path d="M16 2C8.268 2 2 8.268 2 16c0 2.52.665 4.881 1.826 6.937L2.5 29.5l6.628-1.735C11.244 28.725 13.565 29.367 16 29.367c7.732 0 14-6.268 14-14S23.732 2 16 2zm0 25.367c-2.168 0-4.254-.574-6.081-1.654l-.435-.252-4.519 1.184 1.206-4.401-.284-.463C5.266 20.914 4.633 18.772 4.633 16c0-6.268 5.099-11.367 11.367-11.367S27.367 9.732 27.367 16 22.268 27.367 16 27.367z"/>
                                <path d="M22.2 19.2c-.3-.15-1.77-.874-2.044-.974-.274-.1-.474-.15-.674.15-.2.3-.774.974-.949 1.174-.175.2-.349.225-.649.075-3-.15-5.05-3.05-5.225-3.3-.175-.25-1.849-2.449-1.849-4.674 0-2.225 1.175-3.5 1.6-3.974.425-.475.9-.574 1.2-.574.3 0 .6.015.874.075.274.06.474.15.674.574.2.425.674 1.649.749 1.774.075.125.125.274.025.424-.1.15-.15.274-.274.424-.125.15-.262.335-.374.449-.125.125-.255.26-.109.499.146.24.649 1.074 1.399 1.749.974.874 1.799 1.149 2.049 1.274.25.125.397.105.549-.074.15-.179.649-.749.824-1.024.175-.274.349-.225.599-.125.25.1 1.574.749 1.849.874.274.125.457.199.524.3.067.1.067.574-.2 1.124z"/>
                            </svg>
                        </a>
                        <a href="<?php echo INSTAGRAM_URL; ?>" target="_blank" class="social-link" aria-label="Instagram">
                            <svg viewBox="0 0 32 32" class="social-icon">
                                <path d="M16 2C8.269 2 2 8.269 2 16s6.269 14 14 14 14-6.269 14-14S23.731 2 16 2zm0 25.333c-6.267 0-11.333-5.067-11.333-11.333S9.733 4.667 16 4.667c6.267 0 11.333 5.067 11.333 11.333S22.267 27.333 16 27.333z"/>
                                <path d="M21.333 10.667H10.667c-1.467 0-2.667 1.2-2.667 2.667v5.333c0 1.467 1.2 2.667 2.667 2.667h10.667c1.467 0 2.667-1.2 2.667-2.667v-5.333c0-1.467-1.2-2.667-2.667-2.667zm-5.333 8c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zm5.333-6.667c-.533 0-1-.467-1-1s.467-1 1-1 1 .467 1 1-.467 1-1 1z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form animate-on-scroll">
                <h2>Kirim Pesan</h2>
                <form id="contactForm" class="booking-form" action="<?php echo WHATSAPP_URL; ?>" method="GET" target="_blank">
                    <div class="form-group">
                        <label for="contact_name">Nama Lengkap *</label>
                        <input type="text" id="contact_name" name="name" required placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <div class="form-group">
                        <label for="contact_phone">Nomor WhatsApp *</label>
                        <input type="tel" id="contact_phone" name="phone" required placeholder="+62 8xx-xxxx-xxxx">
                    </div>

                    <div class="form-group">
                        <label for="contact_email">Email (Opsional)</label>
                        <input type="email" id="contact_email" name="email" placeholder="email@anda.com">
                    </div>

                    <div class="form-group">
                        <label for="contact_subject">Subjek *</label>
                        <select id="contact_subject" name="subject" required>
                            <option value="">Pilih subjek</option>
                            <option value="Pertanyaan Booking">Pertanyaan Booking</option>
                            <option value="Pertanyaan Umum">Pertanyaan Umum</option>
                            <option value="Kerjasama">Kerjasama</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="contact_message">Pesan *</label>
                        <textarea id="contact_message" name="message" rows="5" required placeholder="Bagaimana kami bisa membantu Anda?"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg" onclick="sendToWhatsApp(event)">Kirim via WhatsApp</button>

                    <p class="booking-note">
                        <small>* Pesan Anda akan dikirim langsung ke WhatsApp kami.</small>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="section section-surface">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Temukan Kami</h2>
            <p class="section-subtitle">Kunjungi kami di Paragon Village Karawaci</p>
        </div>

        <div class="address-panel">
            <p class="address-line">
                <?php echo icon('pin', 20); ?> <?php echo htmlspecialchars(FULL_ADDRESS); ?>
            </p>
            <a href="<?php echo GOOGLE_MAPS_URL; ?>" target="_blank" class="btn btn-primary btn-lg">Buka di Google Maps</a>
        </div>
    </div>
</section>

<script>
function sendToWhatsApp(event) {
    event.preventDefault();

    const name = document.getElementById('contact_name').value;
    const phone = document.getElementById('contact_phone').value;
    const email = document.getElementById('contact_email').value;
    const subject = document.getElementById('contact_subject').value;
    const message = document.getElementById('contact_message').value;

    if (!name || !phone || !subject || !message) {
        alert('Mohon isi semua kolom yang wajib diisi.');
        return;
    }

    let whatsappMessage = `Halo Mumer Room, saya ingin menghubungi Anda.\n\n`;
    whatsappMessage += `Nama: ${name}\n`;
    whatsappMessage += `Nomor WhatsApp: ${phone}\n`;
    if (email) {
        whatsappMessage += `Email: ${email}\n`;
    }
    whatsappMessage += `Subjek: ${subject}\n`;
    whatsappMessage += `Pesan: ${message}\n\n`;
    whatsappMessage += `Terima kasih.`;

    const whatsappUrl = '<?php echo WHATSAPP_URL; ?>?text=' + encodeURIComponent(whatsappMessage);
    window.open(whatsappUrl, '_blank');
}
</script>

<?php require_once INCLUDES_PATH . '/footer.php'; ?>
