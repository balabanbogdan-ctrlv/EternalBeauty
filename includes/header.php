<?php
/**
 * Eternal Beauty — Header & Navigație Responsive
 */

declare(strict_types=1);

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../functions.php';

$page_title = $page_title ?? SITE_NAME . ' — ' . SITE_SLOGAN;
?>
<!DOCTYPE html>
<html lang="ro" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= eb_clean($page_title) ?></title>
    <meta name="description" content="Salon de frumusețe în Chișinău — servicii premium de coafură, manichiură, cosmetică și machiaj.">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#fdf2f4',
                            100: '#fbe5e9',
                            200: '#f7ced6',
                            300: '#f2a8b7',
                            400: '#ea7891',
                            500: '#e04f72',
                            600: '#cb3158',
                            700: '#ab2246',
                            800: '#8e203d',
                            900: '#781f38',
                            950: '#430c1b',
                        },
                        rosegold: {
                            light: '#f4e3df',
                            DEFAULT: '#b76e79',
                            dark: '#93515b',
                        },
                        nude: {
                            50: '#faf7f5',
                            100: '#f4ede8',
                            200: '#e8dbd1',
                            800: '#2c2224',
                        }
                    },
                    fontFamily: {
                        serif: ['Cormorant Garamond', 'Georgia', 'serif'],
                        sans: ['Jost', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Custom CSS & JS -->
    <link rel="stylesheet" href="style.css">
    <script src="main.js" defer></script>

    <!-- EmailJS SDK -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            // Înlocuiește 'PUBLIC_KEY_UL_TAU' cu Public Key-ul din contul EmailJS (Account > API Keys)
            emailjs.init('8om7X4IdLRyPdnPD7');
        })();
    </script>
</head>
<body class="bg-nude-50 text-nude-800 font-sans antialiased selection:bg-brand-200 selection:text-brand-900 flex flex-col min-h-screen">

<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:p-4 focus:bg-brand-900 focus:text-white">Sari la conținutul principal</a>

<!-- Navigation Header -->
<header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-brand-100 shadow-sm transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 sm:h-20">
            <!-- Brand Logo -->
            <a href="index.php" class="font-serif text-xl sm:text-2xl md:text-3xl font-semibold tracking-wide text-brand-950">
                <?= eb_clean(SITE_NAME) ?><span class="text-brand-500">.</span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center gap-6 lg:gap-8" aria-label="Navigație principală">
                <?php foreach ($GLOBALS['nav_links'] as $file => $label): ?>
                    <a href="<?= $file ?>" 
                       class="text-xs lg:text-sm font-medium transition-colors duration-200 hover:text-brand-600 relative py-1 <?= eb_is_active($file) ? 'text-brand-600 font-semibold' : 'text-nude-800/80' ?>">
                        <?= eb_clean($label) ?>
                        <?php if (eb_is_active($file)): ?>
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-brand-500 rounded-full"></span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <!-- CTA Desktop & Button Mobile -->
            <div class="flex items-center gap-2 sm:gap-4">
                <a href="contact.php" class="hidden sm:inline-flex items-center justify-center px-4 sm:px-5 py-2 sm:py-2.5 text-xs sm:text-sm font-medium text-white bg-gradient-to-r from-brand-600 to-brand-700 rounded-full shadow-md shadow-brand-500/20 hover:from-brand-700 hover:to-brand-800 transition-all duration-200">
                    Programare Online
                </a>
                
                <!-- Hamburger Button -->
                <button type="button" class="md:hidden p-2 text-nude-800 hover:text-brand-600 focus:outline-none rounded-lg" id="navToggle" onclick="openMenu()" aria-label="Deschide meniul" aria-expanded="false">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Overlay & Mobile Drawer -->
<div class="fixed inset-0 z-50 bg-brand-950/40 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300" id="mobileOverlay" onclick="closeMenu()"></div>
<div class="fixed top-0 right-0 z-50 w-4/5 max-w-xs sm:max-w-sm h-full bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out p-6 flex flex-col justify-between" id="mobileMenu" aria-hidden="true">
    <div>
        <div class="flex items-center justify-between pb-6 border-b border-brand-100">
            <a href="index.php" class="font-serif text-2xl font-semibold text-brand-950">
                <?= eb_clean(SITE_NAME) ?><span class="text-brand-500">.</span>
            </a>
            <button type="button" class="p-2 text-gray-500 hover:text-brand-600 focus:outline-none" id="mobileClose" onclick="closeMenu()" aria-label="Închide meniul">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <nav class="mt-6 flex flex-col gap-2">
            <?php foreach ($GLOBALS['nav_links'] as $file => $label): ?>
                <a href="<?= $file ?>" class="text-base font-medium p-3 rounded-xl transition-colors <?= eb_is_active($file) ? 'bg-brand-50 text-brand-600 font-semibold' : 'text-nude-800 hover:bg-nude-50' ?>">
                    <?= eb_clean($label) ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>

    <div class="pt-6 border-t border-brand-100">
        <a href="contact.php" class="w-full inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-brand-600 to-brand-700 rounded-full shadow-md hover:from-brand-700 hover:to-brand-800 transition-all">
            Programează-te
        </a>
    </div>
</div>

<main id="main-content" class="flex-grow">