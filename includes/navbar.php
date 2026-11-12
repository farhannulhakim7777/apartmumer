<?php
/**
 * Mumer Room - Navigation Bar
 */
?>
<nav class="navbar">
    <div class="container">
        <div class="navbar-brand">
            <a href="<?php echo baseUrl('index.php'); ?>" class="logo-link">
                <img src="<?php echo imageUrl('logo/logo1.jpeg'); ?>" alt="<?php echo htmlspecialchars(BUSINESS_NAME); ?>" class="logo-image">
                <span class="logo-text"><?php echo htmlspecialchars(BUSINESS_NAME); ?></span>
            </a>
        </div>

        <button class="navbar-toggle" id="navbarToggle" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="navbar-menu" id="navbarMenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?php echo baseUrl('index.php'); ?>" class="nav-link <?php echo isCurrentPage('index.php') ? 'active' : ''; ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo baseUrl('rooms.php'); ?>" class="nav-link <?php echo isCurrentPage('rooms.php') || isCurrentPage('room-detail.php') ? 'active' : ''; ?>">Tipe Unit</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo baseUrl('facilities.php'); ?>" class="nav-link <?php echo isCurrentPage('facilities.php') ? 'active' : ''; ?>">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo baseUrl('gallery.php'); ?>" class="nav-link <?php echo isCurrentPage('gallery.php') ? 'active' : ''; ?>">Galeri</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo baseUrl('location.php'); ?>" class="nav-link <?php echo isCurrentPage('location.php') ? 'active' : ''; ?>">Lokasi</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo baseUrl('faq.php'); ?>" class="nav-link <?php echo isCurrentPage('faq.php') ? 'active' : ''; ?>">FAQ</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo baseUrl('contact.php'); ?>" class="nav-link <?php echo isCurrentPage('contact.php') ? 'active' : ''; ?>">Kontak</a>
                </li>
            </ul>
            <div class="navbar-cta">
                <a href="<?php echo baseUrl('rooms.php'); ?>" class="btn btn-primary">Tanya Sekarang</a>
            </div>
        </div>
    </div>
</nav>
