<?php
/**
 * Eternal Beauty — Configurare globală
 * Constante de site, setări generale, pornire sesiune.
 */
 
declare(strict_types=1);
 
// Pornim sesiunea o singură dată (necesar pentru mesajele flash din formular)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 
// Setări generale ale salonului — modifică aici pentru a actualiza tot site-ul
define('SITE_NAME', 'Eternal Beauty');
define('SITE_SLOGAN', 'Frumusețea care rămâne.');
define('SITE_URL', '/');
define('SITE_PHONE', '+373 29 941 452');
define('SITE_PHONE_LINK', '+37329941452');
define('SITE_EMAIL', 'ebeautycih@gmail.com');
define('SITE_ADDRESS', 'strada Dunării 36, Cahul');
define('SITE_YEAR', date('Y'));
 
// Program de lucru
$GLOBALS['business_hours'] = [
    'Luni – Vineri' => '09:00 – 19:00',
    'Sâmbătă'       => '09:00 – 16:00',
    'Duminică'      => 'Închis',
];
 
// Rețele sociale
$GLOBALS['social_links'] = [
    'Instagram' => 'https://instagram.com',
    'Facebook'  => 'https://facebook.com',
    'TikTok'    => 'https://tiktok.com',
];
 
// Meniu principal — folosit de header.php pentru a genera navbar-ul și footer-ul
$GLOBALS['nav_links'] = [
    'index.php'    => 'Acasă',
    'services.php' => 'Servicii',
    'gallery.php'  => 'Galerie',
    'team.php'     => 'Echipa',
    'reviews.php'  => 'Recenzii',
    'contact.php'  => 'Contact',
    'about.php'    => 'Despre noi',
];
 
// Fișier unde salvăm programările (soluție fără bază de date, ușor de migrat spre MySQL)
define('BOOKINGS_FILE', __DIR__ . '/data/bookings.json');   