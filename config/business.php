<?php
/**
 * Mumer Room - Business Configuration
 * Centralized business information
 */

// Prevent direct access
if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__));
}

require_once CONFIG_PATH . '/constants.php';

// Business Identity
define('BUSINESS_NAME', 'Mumer Room');
define('BUSINESS_TAGLINE', 'Your Comfort, Your Stay');
define('PROPERTY_NAME', 'Paragon Village at Karawaci');

// Contact Information
define('WHATSAPP_NUMBER', '+62 897-6007-508');
define('WHATSAPP_URL', 'https://wa.me/628976007508');
define('INSTAGRAM_URL', 'https://www.instagram.com/mumer_room?igsh=bXc5bzYzanlyeGR5');
define('INSTAGRAM_HANDLE', '@mumer_room');

// Address
define('FULL_ADDRESS', 'Jl. Raya Binong No.9a, Binong, Kec. Curug, Kabupaten Tangerang, Banten 15811, Indonesia');
define('GOOGLE_MAPS_URL', 'https://share.google/ARKqYUJegWA36dZM2');

// SEO
define('SITE_TITLE', 'Mumer Room - Apartment Rental at Paragon Village Karawaci');
define('SITE_DESCRIPTION', 'Discover comfortable apartment stays at Paragon Village Karawaci with Mumer Room. Your comfort, your stay.');
define('SITE_KEYWORDS', 'Mumer Room, Sewa Apartemen Paragon Village, Sewa Kamar Paragon Village Karawaci, Sewa Apartemen Karawaci Tangerang, Apartment Rental Karawaci');

// Room Type Configuration
// These are EXAMPLE photos showing different unit types available
// Actual units may vary in exact layout and decoration
$room_types_config = [
    [
        'id' => 1,
        'name' => 'Studio Type',
        'type' => 'Studio',
        'capacity' => 2,
        'size' => '24-30 sqm',
        'beds' => '1 Queen Bed',
        'image' => 'kamar1.jpeg',
        'description' => 'Contoh tipe unit Studio. Cocok untuk individu atau pasangan. Unit yang tersedia mungkin memiliki variasi layout dan dekorasi.',
        'price_note' => 'Hubungi kami untuk harga',
        'facilities' => ['AC', 'Smart TV', 'Free WiFi', 'YouTube Premium', 'Netflix', 'Kitchenette', 'Bathroom']
    ],
    [
        'id' => 2,
        'name' => '1 Bedroom Type',
        'type' => '1 Bedroom',
        'capacity' => 3,
        'size' => '36-45 sqm',
        'beds' => '1 Queen Bed + 1 Single Bed',
        'image' => 'kamar4.jpeg',
        'description' => 'Contoh tipe unit 1 Bedroom. Cocok untuk keluarga kecil. Unit yang tersedia mungkin memiliki variasi layout dan dekorasi.',
        'price_note' => 'Hubungi kami untuk harga',
        'facilities' => ['AC', 'Smart TV', 'Free WiFi', 'YouTube Premium', 'Netflix', 'Kitchen', 'Bathroom', 'Living Area']
    ],
    [
        'id' => 3,
        'name' => '2 Bedroom Type',
        'type' => '2 Bedroom',
        'capacity' => 4,
        'size' => '50-60 sqm',
        'beds' => '2 Queen Beds',
        'image' => 'kamar7.jpeg',
        'description' => 'Contoh tipe unit 2 Bedroom. Cocok untuk keluarga atau grup. Unit yang tersedia mungkin memiliki variasi layout dan dekorasi.',
        'price_note' => 'Hubungi kami untuk harga',
        'facilities' => ['AC', 'Smart TV', 'Free WiFi', 'YouTube Premium', 'Netflix', 'Kitchen', '2 Bathrooms', 'Living Area', 'Dining Area']
    ]
];

// Facilities Configuration
$facilities_config = [
    'in_room' => [
        ['name' => 'AC (Pendingin Udara)', 'icon' => '❄️'],
        ['name' => 'Smart TV', 'icon' => '📺'],
        ['name' => 'WiFi Gratis', 'icon' => '📶'],
        ['name' => 'YouTube Premium', 'icon' => '▶️'],
        ['name' => 'Netflix', 'icon' => '🎬'],
        ['name' => 'Dapur / Kitchenette', 'icon' => '🍳'],
        ['name' => 'Kamar Mandi Pribadi', 'icon' => '🚿'],
        ['name' => 'Kulkas', 'icon' => '🧊'],
        ['name' => 'Water Heater', 'icon' => '🔥'],
        ['name' => 'Lemari Pakaian', 'icon' => '👕']
    ],
    'building' => [
        ['name' => 'Keamanan 24 Jam', 'icon' => '🔒'],
        ['name' => 'Area Parkir', 'icon' => '🚗'],
        ['name' => 'Lift / Elevator', 'icon' => '🛗'],
        ['name' => 'Kamera CCTV', 'icon' => '📹']
    ],
    'shared' => [
        ['name' => 'Kolam Renang', 'icon' => '🏊'],
        ['name' => 'Pusat Kebugaran / Gym', 'icon' => '💪'],
        ['name' => 'Taman', 'icon' => '🌳'],
        ['name' => 'Ruang Serbaguna', 'icon' => '🏢']
    ],
    'nearby' => [
        ['name' => 'Pusat Perbelanjaan', 'icon' => '🛒'],
        ['name' => 'Restoran & Kuliner', 'icon' => '🍽️'],
        ['name' => 'Rumah Sakit', 'icon' => '🏥'],
        ['name' => 'Sekolah & Kampus', 'icon' => '🎓'],
        ['name' => 'Transportasi Umum', 'icon' => '🚌']
    ]
];

// FAQ Configuration
$faq_config = [
    [
        'question' => 'Bagaimana cara melakukan booking?',
        'answer' => 'Anda dapat melakukan booking melalui website kami dengan mengisi form booking. Setelah mengisi detail, Anda akan diarahkan ke WhatsApp untuk konfirmasi ketersediaan dengan admin.'
    ],
    [
        'question' => 'Apakah bisa menyewa harian?',
        'answer' => 'Silakan hubungi kami melalui WhatsApp untuk informasi mengenai opsi penyewaan harian, mingguan, atau bulanan.'
    ],
    [
        'question' => 'Apakah tersedia penyewaan mingguan dan bulanan?',
        'answer' => 'Ya, kami menyediakan opsi penyewaan mingguan dan bulanan. Hubungi admin melalui WhatsApp untuk harga dan ketersediaan.'
    ],
    [
        'question' => 'Bagaimana sistem pembayaran?',
        'answer' => 'Pembayaran dapat dilakukan melalui transfer bank. Detail pembayaran akan diberikan setelah konfirmasi booking melalui WhatsApp.'
    ],
    [
        'question' => 'Bagaimana ketentuan check-in dan check-out?',
        'answer' => 'Hubungi admin melalui WhatsApp untuk informasi detail mengenai waktu check-in dan check-out.'
    ],
    [
        'question' => 'Bagaimana kebijakan pembatalan?',
        'answer' => 'Kebijakan pembatalan akan dijelaskan saat Anda melakukan konfirmasi booking melalui WhatsApp dengan admin.'
    ],
    [
        'question' => 'Berapa kapasitas maksimal tamu per unit?',
        'answer' => 'Kapasitas bervariasi tergantung tipe unit. Silakan lihat detail setiap kamar untuk informasi kapasitas.'
    ],
    [
        'question' => 'Apakah tersedia fasilitas parkir?',
        'answer' => 'Ya, tersedia area parkir untuk tamu.'
    ],
    [
        'question' => 'Apakah boleh membawa hewan peliharaan?',
        'answer' => 'Hubungi admin melalui WhatsApp untuk informasi mengenai kebijakan hewan peliharaan.'
    ],
    [
        'question' => 'Apakah unit dilengkapi dengan WiFi?',
        'answer' => 'Ya, seluruh unit dilengkapi dengan WiFi gratis.'
    ]
];

// House Rules
$house_rules = [
    'Dilarang merokok di dalam unit',
    'Dilarang membawa tamu melebihi kapasitas',
    'Jaga kebersihan unit selama menginap',
    'Patuhi ketentuan check-in dan check-out',
    'Laporkan kerusakan atau masalah kepada admin segera',
    'Dilarang melakukan aktivitas ilegal di dalam unit'
];

// Gallery Categories
$gallery_categories = [
    'bedroom' => 'Kamar Tidur',
    'living' => 'Ruang Tamu',
    'kitchen' => 'Dapur',
    'bathroom' => 'Kamar Mandi',
    'interior' => 'Interior Apartemen',
    'exterior' => 'Eksterior Gedung',
    'facilities' => 'Fasilitas Umum',
    'surrounding' => 'Area Sekitar'
];

// Helper function to format price
function formatPrice($price) {
    if ($price === null || $price === 0) {
        return 'Hubungi Kami';
    }
    return 'Rp ' . number_format($price, 0, ',', '.');
}

// Helper function to get room type by ID
function getRoomTypeById($id) {
    global $room_types_config;
    foreach ($room_types_config as $room) {
        if ($room['id'] == $id) {
            return $room;
        }
    }
    return null;
}
