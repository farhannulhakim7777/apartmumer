<?php
/**
 * Mumer Room - FAQ Page
 */

if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

require_once APP_ROOT . '/config/constants.php';
require_once APP_ROOT . '/config/business.php';
require_once APP_ROOT . '/includes/functions.php';

$pageTitle = 'FAQ';
$pageDescription = 'Pertanyaan umum seputar sewa apartemen Mumer Room di Paragon Village Karawaci.';

require_once INCLUDES_PATH . '/header.php';

$faqs = getAllFaqs();
?>

<!-- Breadcrumbs -->
<div class="container">
    <div class="breadcrumbs">
        <a href="<?php echo baseUrl('index.php'); ?>">Beranda</a>
        <span class="breadcrumbs-separator">/</span>
        <span>FAQ</span>
    </div>
</div>

<!-- Page Header -->
<section class="section section-surface">
    <div class="container">
        <div class="section-header">
            <p class="eyebrow">FAQ</p>
            <h1 class="section-title">Pertanyaan Umum</h1>
            <p class="section-subtitle">Temukan jawaban atas pertanyaan umum tentang apartemen dan layanan kami</p>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section">
    <div class="container">
        <div class="faq-section">
            <?php foreach ($faqs as $index => $faq): ?>
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
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Masih Punya Pertanyaan?</h2>
        <p>Hubungi kami via WhatsApp untuk bantuan langsung</p>
        <a href="<?php echo WHATSAPP_URL; ?>?text=<?php echo rawurlencode('Halo Mumer Room, saya memiliki pertanyaan lain.'); ?>" target="_blank" class="btn btn-lg">Chat di WhatsApp</a>
    </div>
</section>

<script>
function toggleFaq(index) {
    const faqItem = document.querySelector(`.faq-item:nth-child(${index + 1})`);
    faqItem.classList.toggle('active');
}
</script>

<?php require_once INCLUDES_PATH . '/footer.php'; ?>
