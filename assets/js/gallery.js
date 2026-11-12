/**
 * Mumer Room - Gallery JavaScript
 * Gallery lightbox and filtering functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    initGallery();
    initLightbox();
});

/**
 * Initialize gallery
 */
function initGallery() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const filterButtons = document.querySelectorAll('.gallery-filter button');

    if (galleryItems.length === 0) return;

    // Add click events to gallery items
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', function() {
            const img = this.querySelector('img');
            if (img) {
                openLightbox(img.src, index);
            }
        });
    });

    // Filter functionality
    if (filterButtons.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');

                const filter = this.dataset.filter;

                // Filter gallery items
                galleryItems.forEach(item => {
                    if (filter === 'all' || item.dataset.category === filter) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 10);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    }
}

/**
 * Initialize lightbox
 */
function initLightbox() {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxClose = document.getElementById('lightboxClose');
    const lightboxPrev = document.getElementById('lightboxPrev');
    const lightboxNext = document.getElementById('lightboxNext');

    if (!lightbox) return;

    // Close lightbox
    if (lightboxClose) {
        lightboxClose.addEventListener('click', closeLightbox);
    }

    // Navigate with buttons
    if (lightboxPrev) {
        lightboxPrev.addEventListener('click', navigateLightbox('prev'));
    }

    if (lightboxNext) {
        lightboxNext.addEventListener('click', navigateLightbox('next'));
    }

    // Close on background click
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && lightbox.classList.contains('active')) {
            closeLightbox();
        }
        if (e.key === 'ArrowLeft' && lightbox.classList.contains('active')) {
            navigateLightbox('prev')();
        }
        if (e.key === 'ArrowRight' && lightbox.classList.contains('active')) {
            navigateLightbox('next')();
        }
    });
}

/**
 * Open lightbox
 */
function openLightbox(src, index) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');

    if (!lightbox || !lightboxImage) return;

    lightboxImage.src = src;
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';

    // Store current index for navigation
    lightbox.dataset.currentIndex = index;
}

/**
 * Close lightbox
 */
function closeLightbox() {
    const lightbox = document.getElementById('lightbox');

    if (!lightbox) return;

    lightbox.classList.remove('active');
    document.body.style.overflow = '';
}

/**
 * Navigate lightbox
 */
function navigateLightbox(direction) {
    return function() {
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightboxImage');
        const galleryItems = document.querySelectorAll('.gallery-item');

        if (!lightbox || !lightboxImage || galleryItems.length === 0) return;

        let currentIndex = parseInt(lightbox.dataset.currentIndex) || 0;

        if (direction === 'next') {
            currentIndex = (currentIndex + 1) % galleryItems.length;
        } else {
            currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
        }

        const nextItem = galleryItems[currentIndex];
        const nextImg = nextItem.querySelector('img');

        if (nextImg) {
            lightboxImage.style.opacity = '0';
            setTimeout(() => {
                lightboxImage.src = nextImg.src;
                lightboxImage.style.opacity = '1';
            }, 200);
        }

        lightbox.dataset.currentIndex = currentIndex;
    };
}

/**
 * Initialize room detail gallery
 */
function initRoomDetailGallery() {
    const mainImage = document.querySelector('.room-detail-main-image img');
    const thumbnails = document.querySelectorAll('.room-detail-thumbnails img');

    if (!mainImage || thumbnails.length === 0) return;

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Update main image
            mainImage.style.opacity = '0';
            setTimeout(() => {
                mainImage.src = this.src;
                mainImage.style.opacity = '1';
            }, 200);

            // Update active state
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
}

// Initialize room detail gallery if on room detail page
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.room-detail-thumbnails')) {
        initRoomDetailGallery();
    }
});
