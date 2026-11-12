<?php
/**
 * Mumer Room - Room Detail Page
 */

if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

require_once APP_ROOT . '/config/constants.php';
require_once APP_ROOT . '/config/business.php';
require_once APP_ROOT . '/includes/functions.php';

// Get room type ID from URL
$roomTypeId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$roomType = getRoomTypeById($roomTypeId);

if (!$roomType) {
    header('Location: ' . baseUrl('rooms.php'));
    exit;
}

$pageTitle = $roomType['name'] . ' - ' . $roomType['type'];
$pageDescription = $roomType['description'];

require_once INCLUDES_PATH . '/header.php';

$houseRules = getHouseRules();
$allRoomTypes = getAllRoomTypes();
?>

<!-- Breadcrumbs -->
<div class="container">
    <div class="breadcrumbs">
        <a href="<?php echo baseUrl('index.php'); ?>">Beranda</a>
        <span class="breadcrumbs-separator">/</span>
        <a href="<?php echo baseUrl('rooms.php'); ?>">Tipe Unit</a>
        <span class="breadcrumbs-separator">/</span>
        <span><?php echo htmlspecialchars($roomType['name']); ?></span>
    </div>
</div>

<!-- Room Detail -->
<section class="section">
    <div class="container">
        <div class="room-detail">
            <!-- Gallery Section -->
            <div class="room-detail-gallery">
                <div class="room-detail-main-image">
                    <img src="<?php echo imageUrl('rooms/' . $roomType['image']); ?>" alt="<?php echo htmlspecialchars($roomType['name']); ?>" id="mainImage">
                </div>
                <div class="room-detail-thumbnails">
                    <img src="<?php echo imageUrl('rooms/' . $roomType['image']); ?>" alt="<?php echo htmlspecialchars($roomType['name']); ?>" class="active" onclick="changeMainImage(this)">
                    <?php
                    // Get other room type images as thumbnails
                    $otherTypes = array_filter($allRoomTypes, function($r) use ($roomType) {
                        return $r['id'] !== $roomType['id'];
                    });
                    $thumbnails = array_slice($otherTypes, 0, 3);
                    foreach ($thumbnails as $thumb):
                    ?>
                        <img src="<?php echo imageUrl('rooms/' . $thumb['image']); ?>" alt="<?php echo htmlspecialchars($thumb['name']); ?>" onclick="changeMainImage(this)">
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Info Section -->
            <div class="room-detail-info">
                <div class="notice">
                    <p>
                        <strong>Catatan:</strong> Foto di atas adalah contoh dari tipe unit ini. Unit yang tersedia mungkin memiliki variasi layout dan dekorasi.
                    </p>
                </div>

                <div class="room-detail-type"><?php echo htmlspecialchars($roomType['type']); ?></div>
                <h1 class="room-detail-name"><?php echo htmlspecialchars($roomType['name']); ?></h1>

                <div class="room-detail-description">
                    <?php echo htmlspecialchars($roomType['description']); ?>
                </div>

                <div class="room-detail-specs">
                    <div class="room-spec-item">
                        <span class="room-spec-icon"><?php echo icon('users'); ?></span>
                        <div>
                            <div class="room-spec-label">Kapasitas</div>
                            <div class="room-spec-value"><?php echo $roomType['capacity']; ?> Tamu</div>
                        </div>
                    </div>
                    <div class="room-spec-item">
                        <span class="room-spec-icon"><?php echo icon('ruler'); ?></span>
                        <div>
                            <div class="room-spec-label">Ukuran</div>
                            <div class="room-spec-value"><?php echo htmlspecialchars($roomType['size']); ?></div>
                        </div>
                    </div>
                    <div class="room-spec-item">
                        <span class="room-spec-icon"><?php echo icon('bed'); ?></span>
                        <div>
                            <div class="room-spec-label">Tempat Tidur</div>
                            <div class="room-spec-value"><?php echo htmlspecialchars($roomType['beds']); ?></div>
                        </div>
                    </div>
                    <div class="room-spec-item">
                        <span class="room-spec-icon"><?php echo icon('home'); ?></span>
                        <div>
                            <div class="room-spec-label">Tipe Unit</div>
                            <div class="room-spec-value"><?php echo htmlspecialchars($roomType['type']); ?></div>
                        </div>
                    </div>
                </div>

                <div class="room-detail-facilities">
                    <h3>Fasilitas Unit</h3>
                    <div class="facility-tags">
                        <?php foreach ($roomType['facilities'] as $facility): ?>
                            <span class="facility-tag">✓ <?php echo htmlspecialchars($facility); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="room-detail-price">
                    <div class="price-label">Harga</div>
                    <div class="price-value"><?php echo htmlspecialchars($roomType['price_note']); ?></div>
                    <div class="fine-print">
                        <p><strong>Catatan:</strong> Hubungi kami via WhatsApp untuk informasi harga dan ketersediaan unit.</p>
                    </div>
                </div>

                <div class="room-detail-rules">
                    <h3>Peraturan Menginap</h3>
                    <ul>
                        <?php foreach ($houseRules as $rule): ?>
                            <li><?php echo htmlspecialchars($rule); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="stack-top-sm">
                    <a href="<?php echo WHATSAPP_URL; ?>?text=<?php echo rawurlencode('Halo Mumer Room, saya ingin bertanya mengenai ketersediaan unit tipe ' . $roomType['name'] . '. Mohon informasi harga dan ketersediaan.'); ?>" target="_blank" class="btn btn-primary btn-block btn-lg">
                        <?php echo icon('whatsapp', 18); ?> Tanya via WhatsApp
                    </a>
                    <p class="fine-print is-center">
                        Kami akan merespons secepatnya dengan informasi ketersediaan dan harga
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Other Unit Types -->
<section class="section section-surface">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Tipe Unit Lainnya</h2>
            <p class="section-subtitle">Jelajahi pilihan lainnya</p>
        </div>

        <div class="rooms-grid">
            <?php
            $otherTypesList = array_filter($allRoomTypes, function($r) use ($roomType) {
                return $r['id'] !== $roomType['id'];
            });
            $otherTypesPreview = array_slice($otherTypesList, 0, 3);
            foreach ($otherTypesPreview as $otherType):
            ?>
                <div class="room-card">
                    <div class="room-image">
                        <img src="<?php echo imageUrl('rooms/' . $otherType['image']); ?>" alt="<?php echo htmlspecialchars($otherType['name']); ?>" loading="lazy">
                        <span class="badge-example">Foto Contoh</span>
                    </div>
                    <div class="room-content">
                        <div class="room-type"><?php echo htmlspecialchars($otherType['type']); ?></div>
                        <h3 class="room-name"><?php echo htmlspecialchars($otherType['name']); ?></h3>
                        <div class="room-details">
                            <div class="room-detail-item">
                                <span class="icon-wrap"><?php echo icon('users', 16); ?></span>
                                <span><?php echo $otherType['capacity']; ?> Tamu</span>
                            </div>
                            <div class="room-detail-item">
                                <span class="icon-wrap"><?php echo icon('ruler', 16); ?></span>
                                <span><?php echo htmlspecialchars($otherType['size']); ?></span>
                            </div>
                        </div>
                        <div class="room-price">
                            <?php echo htmlspecialchars($otherType['price_note']); ?>
                        </div>
                        <div class="room-actions">
                            <a href="<?php echo baseUrl('room-detail.php?id=' . $otherType['id']); ?>" class="btn btn-outline">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
function changeMainImage(thumbnail) {
    const mainImage = document.getElementById('mainImage');
    const thumbnails = document.querySelectorAll('.room-detail-thumbnails img');

    mainImage.style.opacity = '0';
    setTimeout(() => {
        mainImage.src = thumbnail.src;
        mainImage.style.opacity = '1';
    }, 200);

    thumbnails.forEach(t => t.classList.remove('active'));
    thumbnail.classList.add('active');
}
</script>

<?php require_once INCLUDES_PATH . '/footer.php'; ?>
