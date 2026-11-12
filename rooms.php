<?php
/**
 * Mumer Room - Rooms Listing Page
 */

if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

require_once APP_ROOT . '/config/constants.php';
require_once APP_ROOT . '/config/business.php';
require_once APP_ROOT . '/includes/functions.php';

$pageTitle = 'Tipe Unit Kami';
$pageDescription = 'Lihat tipe unit apartemen kami di Paragon Village Karawaci. Foto merupakan contoh dari masing-masing tipe unit.';

require_once INCLUDES_PATH . '/header.php';

$roomTypes = getAllRoomTypes();
$typeCategories = getRoomTypeCategories();

// Get filter values
$filterType = isset($_GET['type']) ? $_GET['type'] : '';
$filterCapacity = isset($_GET['capacity']) ? intval($_GET['capacity']) : 0;

// Apply filters
$filteredTypes = $roomTypes;
if ($filterType) {
    $filteredTypes = array_filter($filteredTypes, function($type) use ($filterType) {
        return strtolower($type['type']) === strtolower($filterType);
    });
}
if ($filterCapacity) {
    $filteredTypes = array_filter($filteredTypes, function($type) use ($filterCapacity) {
        return $type['capacity'] >= $filterCapacity;
    });
}
?>

<!-- Breadcrumbs -->
<div class="container">
    <div class="breadcrumbs">
        <a href="<?php echo baseUrl('index.php'); ?>">Beranda</a>
        <span class="breadcrumbs-separator">/</span>
        <span>Tipe Unit</span>
    </div>
</div>

<!-- Page Header -->
<section class="section section-surface">
    <div class="container">
        <div class="section-header">
            <p class="eyebrow">Tipe Unit</p>
            <h1 class="section-title">Tipe Unit Tersedia</h1>
            <p class="section-subtitle">Jelajahi tipe unit apartemen kami (foto merupakan contoh masing-masing tipe)</p>
        </div>
    </div>
</section>

<!-- Filters -->
<section class="section">
    <div class="container">
        <div class="filters">
            <h3 class="filters-title">Filter Tipe Unit</h3>
            <form class="filters-grid" method="GET" action="<?php echo baseUrl('rooms.php'); ?>">
                <div class="form-group">
                    <label for="filter_type">Tipe Unit</label>
                    <select id="filter_type" name="type">
                        <option value="">Semua Tipe</option>
                        <?php foreach ($typeCategories as $type): ?>
                            <option value="<?php echo htmlspecialchars($type); ?>" <?php echo $filterType === $type ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($type); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="filter_capacity">Kapasitas Minimum</label>
                    <select id="filter_capacity" name="capacity">
                        <option value="">Semua</option>
                        <?php for ($i = 1; $i <= MAX_GUESTS_PER_ROOM; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php echo $filterCapacity === $i ? 'selected' : ''; ?>>
                                <?php echo $i; ?>+ Tamu
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block">Terapkan Filter</button>
                </div>
                <div class="form-group">
                    <label>&nbsp;</label>
                    <a href="<?php echo baseUrl('rooms.php'); ?>" class="btn btn-outline btn-block">Hapus Filter</a>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Unit Types Grid -->
<section class="section">
    <div class="container">
        <?php if (count($filteredTypes) > 0): ?>
            <div class="rooms-grid">
                <?php foreach ($filteredTypes as $type): ?>
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
                                <div class="room-detail-item">
                                    <span class="icon-wrap"><?php echo icon('bed', 16); ?></span>
                                    <span><?php echo htmlspecialchars($type['beds']); ?></span>
                                </div>
                            </div>
                            <p class="room-excerpt">
                                <?php echo htmlspecialchars(truncateText($type['description'], 100)); ?>
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
        <?php else: ?>
            <div class="empty-state">
                <h3>Tipe unit tidak ditemukan</h3>
                <p>Coba sesuaikan filter untuk melihat lebih banyak pilihan.</p>
                <a href="<?php echo baseUrl('rooms.php'); ?>" class="btn btn-primary">Hapus Filter</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Butuh Bantuan Memilih?</h2>
        <p>Hubungi kami via WhatsApp untuk rekomendasi yang sesuai kebutuhan Anda</p>
        <a href="<?php echo WHATSAPP_URL; ?>?text=<?php echo rawurlencode('Halo Mumer Room, saya butuh rekomendasi tipe unit.'); ?>" target="_blank" class="btn btn-lg">Chat di WhatsApp</a>
    </div>
</section>

<?php require_once INCLUDES_PATH . '/footer.php'; ?>
