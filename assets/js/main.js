/**
 * Mumer Room - Main JavaScript
 * Core functionality for the website
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    initNavbar();
    initSmoothScroll();
    initAnimations();
});

/**
 * Navbar functionality
 */
function initNavbar() {
    const navbarToggle = document.getElementById('navbarToggle');
    const navbarMenu = document.getElementById('navbarMenu');
    const navbar = document.querySelector('.navbar');

    function setMenu(open) {
        if (!navbarToggle || !navbarMenu) return;
        navbarMenu.classList.toggle('active', open);
        navbarToggle.classList.toggle('active', open);
        navbarToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        document.body.classList.toggle('nav-locked', open);
        if (navbar) navbar.classList.toggle('menu-open', open);
    }

    if (navbarToggle && navbarMenu) {
        navbarToggle.setAttribute('aria-expanded', 'false');
        navbarToggle.setAttribute('aria-controls', 'navbarMenu');

        navbarToggle.addEventListener('click', function() {
            setMenu(!navbarMenu.classList.contains('active'));
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!navbarToggle.contains(e.target) && !navbarMenu.contains(e.target)) setMenu(false);
        });

        // Close menu when clicking a link
        navbarMenu.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() { setMenu(false); });
        });

        // Close on Escape / when resizing up to desktop
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') setMenu(false); });
        window.addEventListener('resize', debounce(function() { if (window.innerWidth > 1024) setMenu(false); }, 150));
    }

    // Navbar scroll effect (passive + rAF)
    if (navbar) {
        let ticking = false;
        const update = function() {
            navbar.classList.toggle('scrolled', window.scrollY > 24);
            ticking = false;
        };
        window.addEventListener('scroll', function() {
            if (!ticking) { ticking = true; requestAnimationFrame(update); }
        }, { passive: true });
        update();
    }
}

/**
 * Smooth scroll for anchor links
 */
function initSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');

            if (href === '#') return;

            const target = document.querySelector(href);

            if (target) {
                e.preventDefault();
                const headerOffset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: reduce ? 'auto' : 'smooth'
                });
            }
        });
    });
}

/**
 * Scroll animations: reveal with light stagger + subtle hero parallax
 */
function initAnimations() {
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (reduce || !('IntersectionObserver' in window)) {
        animatedElements.forEach(el => el.classList.add('animate-in'));
        return;
    }

    // Stagger siblings that share a parent (grids, lists)
    const counts = new Map();
    animatedElements.forEach(el => {
        const n = counts.get(el.parentNode) || 0;
        counts.set(el.parentNode, n + 1);
        el.style.setProperty('--reveal-delay', Math.min(n, 5) * 80 + 'ms');
    });

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    animatedElements.forEach(el => observer.observe(el));

    // Subtle parallax on [data-parallax] images (desktop only)
    const parallax = document.querySelectorAll('[data-parallax]');
    if (parallax.length && window.innerWidth > 1024) {
        let ticking = false;
        const run = function() {
            parallax.forEach(img => {
                const speed = parseFloat(img.dataset.parallax) || 0.05;
                img.style.translate = '0 ' + (window.scrollY * speed).toFixed(1) + 'px';
            });
            ticking = false;
        };
        window.addEventListener('scroll', function() {
            if (!ticking) { ticking = true; requestAnimationFrame(run); }
        }, { passive: true });
    }
}

/**
 * Utility function to debounce
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Utility function to throttle
 */
function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

/**
 * Format date for display
 */
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
}

/**
 * Calculate days between two dates
 */
function calculateDays(checkIn, checkOut) {
    const inDate = new Date(checkIn);
    const outDate = new Date(checkOut);
    const diffTime = Math.abs(outDate - inDate);
    return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
}

/**
 * Validate Indonesian phone number
 */
function validateIndonesianPhone(phone) {
    // Remove spaces, dashes, and parentheses
    const cleaned = phone.replace(/[\s\-\(\)]/g, '');
    // Check if starts with +62 or 62 or 0
    return /^(\+62|62|0)[0-9]{9,13}$/.test(cleaned);
}

/**
 * Show alert message
 */
function showAlert(message, type = 'info') {
    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    alert.textContent = message;

    const container = document.querySelector('.container') || document.body;
    container.insertBefore(alert, container.firstChild);

    setTimeout(() => {
        alert.remove();
    }, 5000);
}

/**
 * Loading state for buttons
 */
function setButtonLoading(button, isLoading) {
    if (isLoading) {
        button.disabled = true;
        button.classList.add('is-loading');
        button.dataset.originalText = button.textContent;
        button.textContent = 'Loading...';
    } else {
        button.disabled = false;
        button.classList.remove('is-loading');
        button.textContent = button.dataset.originalText || button.textContent;
    }
}
