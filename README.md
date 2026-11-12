# Mumer Room - Apartment Rental Website

Premium apartment rental website for Paragon Village at Karawaci, Tangerang, Indonesia.

Built with PHP Native, HTML5, CSS3, and Vanilla JavaScript.

## 🏠 Business Information

- **Brand Name:** Mumer Room
- **Property:** Paragon Village at Karawaci
- **Address:** Jl. Raya Binong No.9a, Binong, Kec. Curug, Kabupaten Tangerang, Banten 15811, Indonesia
- **WhatsApp:** +62 897-6007-508
- **Instagram:** @mumer_room
- **Google Maps:** https://share.google/ARKqYUJegWA36dZM2

## 📋 Features

- **Homepage:** Hero section, featured unit types, facilities preview, gallery preview, location preview, FAQ preview
- **Unit Types Listing:** Browse available unit types with filters (type, capacity) - photos are examples
- **Unit Type Detail:** Detailed unit type information, gallery, facilities, WhatsApp inquiry
- **Facilities:** In-room, building, shared, and nearby facilities
- **Gallery:** Photo gallery with lightbox and category filtering
- **Location:** Address, nearby facilities, transportation information, Google Maps integration
- **FAQ:** Interactive accordion with common questions
- **Contact:** Contact form with WhatsApp integration, contact information
- **Inquiry System:** WhatsApp-based inquiry for unit availability and pricing

## 🛠️ Technology Stack

- **Backend:** PHP Native 8.2+
- **Frontend:** HTML5, CSS3, Vanilla JavaScript
- **Database:** MySQL (optional, for future development)
- **Server:** Apache/Nginx with PHP support

## 📁 Project Structure

```
mumer-room/
├── index.php                    # Homepage
├── rooms.php                    # Unit types listing
├── room-detail.php              # Unit type detail page
├── facilities.php               # Facilities page
├── gallery.php                  # Gallery page
├── location.php                 # Location page
├── faq.php                      # FAQ page
├── contact.php                  # Contact page
├── booking.php                  # Booking processing (optional)
│
├── config/
│   ├── business.php             # Business configuration
│   └── constants.php            # Global constants
│
├── includes/
│   ├── header.php               # HTML header
│   ├── footer.php               # HTML footer
│   ├── navbar.php               # Navigation bar
│   ├── functions.php            # Helper functions
│   ├── security.php             # Security functions
│   └── booking-form.php         # Inquiry form
│
├── assets/
│   ├── css/
│   │   ├── style.css            # Main stylesheet
│   │   ├── components.css       # Component styles
│   │   └── responsive.css       # Media queries
│   │
│   ├── js/
│   │   ├── main.js              # Main JavaScript
│   │   ├── booking.js           # Booking form logic
│   │   └── gallery.js           # Gallery lightbox
│   │
│   └── images/
│       ├── logo/                # Logo files
│       ├── rooms/               # Unit type example photos
│       ├── facilities/          # Facility images
│       └── gallery/              # Gallery images
│
└── README.md                    # This file
```

## 🚀 Installation (XAMPP)

### Prerequisites

- XAMPP (or any PHP development environment)
- PHP 8.2 or higher
- Apache web server

### Steps

1. **Install XAMPP**
   - Download XAMPP from https://www.apachefriends.org/
   - Install and run XAMPP
   - Start Apache and MySQL modules from XAMPP Control Panel

2. **Copy Project Files**
   - Copy the entire `mumer-room` folder to:
     ```
     C:\xampp\htdocs\mumer-room\
     ```
   - Or place it in your web server's document root

3. **Configure Base URL**
   - Open `config/constants.php`
   - Update the `BASE_URL` constant if needed:
     ```php
     define('BASE_URL', '/mumer-room');
     ```

4. **Update Business Information**
   - Open `config/business.php`
   - Update room information, prices, facilities, FAQ as needed
   - All business information is centralized in this file

5. **Access the Website**
   - Open your browser and go to:
     ```
     http://localhost/mumer-room/
     ```

## 🌐 Deployment (PHP Hosting)

### Prerequisites

- PHP hosting with PHP 8.2 or higher
- Apache or Nginx web server
- FTP or file manager access
- Domain name (optional)

### Steps

1. **Prepare Files**
   - Compress the entire project folder into a ZIP file
   - Exclude any development files or folders (if any)

2. **Upload to Hosting**
   - Use FTP or hosting file manager
   - Upload all files to the `public_html` or `www` directory
   - Maintain the folder structure

3. **Configure Base URL**
   - Open `config/constants.php`
   - Update `BASE_URL` to match your domain:
     ```php
     define('BASE_URL', ''); // Empty if in root
     // or
     define('BASE_URL', '/subfolder'); // If in subfolder
     ```

4. **Set File Permissions**
   - Ensure PHP files have appropriate permissions (644)
   - Ensure directories have appropriate permissions (755)

5. **Configure HTTPS**
   - Enable SSL/HTTPS certificate on your hosting
   - Update any hardcoded HTTP URLs to HTTPS (if any)

6. **Test the Website**
   - Access your domain in a browser
   - Test all pages and functionality
   - Test the booking form and WhatsApp integration

## ⚙️ Configuration

### Update Business Information

All business information is in `config/business.php`:

```php
// Business Identity
define('BUSINESS_NAME', 'Mumer Room');
define('BUSINESS_TAGLINE', 'Your Comfort, Your Stay');
define('PROPERTY_NAME', 'Paragon Village at Karawaci');

// Contact Information
define('WHATSAPP_NUMBER', '+62 897-6007-508');
define('WHATSAPP_URL', 'https://wa.me/628976007508');
define('INSTAGRAM_URL', 'https://www.instagram.com/mumer_room');
define('INSTAGRAM_HANDLE', '@mumer_room');

// Address
define('FULL_ADDRESS', 'Jl. Raya Binong No.9a, Binong, Kec. Curug, Kabupaten Tangerang, Banten 15811, Indonesia');
define('GOOGLE_MAPS_URL', 'https://share.google/ARKqYUJegWA36dZM2');
```

### Update Unit Type Information

Edit the `$room_types_config` array in `config/business.php`:

```php
$room_types_config = [
    [
        'id' => 1,
        'name' => 'Studio Type',
        'type' => 'Studio',
        'capacity' => 2,
        'size' => '24-30 sqm',
        'beds' => '1 Queen Bed',
        'image' => 'kamar1.jpeg',
        'description' => 'Contoh tipe unit Studio. Unit yang tersedia mungkin memiliki variasi layout dan dekorasi.',
        'price_note' => 'Hubungi kami untuk harga',
        'facilities' => ['AC', 'TV', 'WiFi', 'Kitchenette', 'Bathroom']
    ],
    // Add more unit types...
];
```

**Important:** Photos are examples of unit types, not specific available units. Units may vary in exact layout and decoration.

### Update Facilities

Edit the `$facilities_config` array in `config/business.php`:

```php
$facilities_config = [
    'in_room' => [
        ['name' => 'Air Conditioning', 'icon' => '❄️'],
        // Add more...
    ],
    'building' => [...],
    'shared' => [...],
    'nearby' => [...]
];
```

### Update FAQ

Edit the `$faq_config` array in `config/business.php`:

```php
$faq_config = [
    [
        'question' => 'Your question here?',
        'answer' => 'Your answer here.'
    ],
    // Add more FAQs...
];
```

## 🔒 Security Features

- CSRF token protection for forms
- Input sanitization and validation
- Output escaping (XSS protection)
- Rate limiting for form submissions
- Secure session configuration
- Secure HTTP headers
- SQL injection protection (when using database)

## 📱 Responsive Design

The website is fully responsive and optimized for:
- Desktop (1280px+)
- Laptop (1024px - 1279px)
- Tablet (768px - 1023px)
- Mobile (320px - 767px)

## 🎨 Customization

### Colors

Edit CSS variables in `assets/css/style.css`:

```css
:root {
    --color-navy: #1a2332;
    --color-beige: #f5f0e8;
    --color-gold: #c9a962;
    /* Add more colors... */
}
```

### Fonts

The website uses Google Fonts:
- Plus Jakarta Sans (Primary)
- Inter (Secondary)
- Manrope (Body)

Change fonts in `assets/css/style.css`:

```css
:root {
    --font-primary: 'Your Font', sans-serif;
    --font-secondary: 'Your Font', sans-serif;
    --font-body: 'Your Font', sans-serif;
}
```

## 🐛 Troubleshooting

### CSS/JS Not Loading

- Check file paths in `includes/header.php`
- Verify `BASE_URL` in `config/constants.php`
- Clear browser cache

### Images Not Displaying

- Verify images are in `assets/images/` subdirectories
- Check file permissions
- Verify image paths in configuration

### Booking Form Not Working

- Check JavaScript console for errors
- Verify `booking.php` exists and is accessible
- Check PHP error logs
- Verify CSRF token is being generated

### WhatsApp Not Opening

- Verify `WHATSAPP_URL` in `config/business.php`
- Check if pop-up blocker is enabled
- Test the URL directly in browser

## 📞 Support

For support or questions:
- WhatsApp: +62 897-6007-508
- Instagram: @mumer_room

## 📄 License

This project is proprietary and confidential property of Mumer Room.

## 🙏 Acknowledgments

- Paragon Village at Karawaci
- All contributors and developers

---

**Built with ❤️ for Mumer Room**
