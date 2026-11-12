    </main>

    <!-- WhatsApp Floating Button -->
    <a href="<?php echo WHATSAPP_URL; ?>?text=<?php echo rawurlencode('Halo Mumer Room, saya ingin bertanya mengenai penyewaan apartemen.'); ?>" target="_blank" class="whatsapp-float" aria-label="Chat di WhatsApp">
        <svg viewBox="0 0 32 32" class="whatsapp-icon">
            <path d="M16 2C8.268 2 2 8.268 2 16c0 2.52.665 4.881 1.826 6.937L2.5 29.5l6.628-1.735C11.244 28.725 13.565 29.367 16 29.367c7.732 0 14-6.268 14-14S23.732 2 16 2zm0 25.367c-2.168 0-4.254-.574-6.081-1.654l-.435-.252-4.519 1.184 1.206-4.401-.284-.463C5.266 20.914 4.633 18.772 4.633 16c0-6.268 5.099-11.367 11.367-11.367S27.367 9.732 27.367 16 22.268 27.367 16 27.367z"/>
            <path d="M22.2 19.2c-.3-.15-1.77-.874-2.044-.974-.274-.1-.474-.15-.674.15-.2.3-.774.974-.949 1.174-.175.2-.349.225-.649.075-3-.15-5.05-3.05-5.225-3.3-.175-.25-1.849-2.449-1.849-4.674 0-2.225 1.175-3.5 1.6-3.974.425-.475.9-.574 1.2-.574.3 0 .6.015.874.075.274.06.474.15.674.574.2.425.674 1.649.749 1.774.075.125.125.274.025.424-.1.15-.15.274-.274.424-.125.15-.262.335-.374.449-.125.125-.255.26-.109.499.146.24.649 1.074 1.399 1.749.974.874 1.799 1.149 2.049 1.274.25.125.397.105.549-.074.15-.179.649-.749.824-1.024.175-.274.349-.225.599-.125.25.1 1.574.749 1.849.874.274.125.457.199.524.3.067.1.067.574-.2 1.124z"/>
        </svg>
    </a>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <div class="footer-brand">
                        <img src="<?php echo imageUrl('logo/logo1.jpeg'); ?>" alt="<?php echo htmlspecialchars(BUSINESS_NAME); ?>" class="footer-logo">
                        <h3><?php echo htmlspecialchars(BUSINESS_NAME); ?></h3>
                        <p class="footer-tagline"><?php echo htmlspecialchars(BUSINESS_TAGLINE); ?></p>
                    </div>
                    <p class="footer-description">
                        Penyewaan apartemen premium di Paragon Village Karawaci. Kenyamanan Anda, Pilihan Anda.
                    </p>
                </div>

                <div class="footer-section">
                    <h4>Tautan Cepat</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo baseUrl('index.php'); ?>">Beranda</a></li>
                        <li><a href="<?php echo baseUrl('rooms.php'); ?>">Tipe Unit</a></li>
                        <li><a href="<?php echo baseUrl('facilities.php'); ?>">Fasilitas</a></li>
                        <li><a href="<?php echo baseUrl('gallery.php'); ?>">Galeri</a></li>
                        <li><a href="<?php echo baseUrl('location.php'); ?>">Lokasi</a></li>
                        <li><a href="<?php echo baseUrl('faq.php'); ?>">FAQ</a></li>
                        <li><a href="<?php echo baseUrl('contact.php'); ?>">Kontak</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Hubungi Kami</h4>
                    <ul class="footer-contact">
                        <li>
                            <span class="contact-icon"><?php echo icon('pin'); ?></span>
                            <span><?php echo htmlspecialchars(FULL_ADDRESS); ?></span>
                        </li>
                        <li>
                            <span class="contact-icon"><?php echo icon('phone'); ?></span>
                            <a href="<?php echo WHATSAPP_URL; ?>" target="_blank"><?php echo htmlspecialchars(WHATSAPP_NUMBER); ?></a>
                        </li>
                        <li>
                            <span class="contact-icon"><?php echo icon('camera'); ?></span>
                            <a href="<?php echo INSTAGRAM_URL; ?>" target="_blank"><?php echo htmlspecialchars(INSTAGRAM_HANDLE); ?></a>
                        </li>
                    </ul>
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

                <div class="footer-section">
                    <h4>Lokasi</h4>
                    <p class="footer-address"><?php echo htmlspecialchars(FULL_ADDRESS); ?></p>
                    <a href="<?php echo GOOGLE_MAPS_URL; ?>" target="_blank" class="btn btn-outline btn-sm">Buka di Google Maps</a>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars(BUSINESS_NAME); ?>. Hak cipta dilindungi.</p>
                <p><?php echo htmlspecialchars(PROPERTY_NAME); ?>, Tangerang, Indonesia</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="<?php echo assetUrl('js/main.js'); ?>"></script>
    <script src="<?php echo assetUrl('js/booking.js'); ?>"></script>
    <script src="<?php echo assetUrl('js/gallery.js'); ?>"></script>
</body>
</html>
