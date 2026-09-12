<?php
$page_title = 'Eternal Beauty — Acasă';
require_once __DIR__ . '/includes/header.php';

$offers = require __DIR__ . '/data/offers.php';
$testimonials = require __DIR__ . '/data/testimonials.php';
?>

<!-- HERO SECTION (Mobile / Tabletă / Desktop) -->
<section class="relative overflow-hidden bg-rose-gradient py-12 sm:py-20 lg:py-28">
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 sm:w-96 sm:h-96 bg-brand-200/40 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-60 h-60 sm:w-80 sm:h-80 bg-rosegold-light/50 rounded-full blur-2xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-8 items-center">
            
            <!-- Hero Text -->
            <div class="md:col-span-1 lg:col-span-7 text-center md:text-left">
                <span class="inline-block px-3 py-1 sm:px-4 sm:py-1.5 rounded-full bg-brand-100 text-brand-800 font-medium text-xs tracking-widest uppercase mb-4 sm:mb-6 border border-brand-200">
                    Salon Premium de Frumusețe
                </span>
                <h1 class="font-serif text-3xl sm:text-5xl lg:text-7xl font-semibold text-brand-950 leading-tight mb-4 sm:mb-6">
                    <?= eb_clean(SITE_SLOGAN) ?>
                </h1>
                <p class="text-base sm:text-lg lg:text-xl text-nude-800/80 font-light max-w-2xl mx-auto md:mx-0 mb-6 sm:mb-8 leading-relaxed">
                    O oază de răsfăț și rafinament în culori calde de roz. Descoperă serviciile noastre de excepție create pentru a-ți pune în valoare eleganța unică.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center md:justify-start">
                    <a href="contact.php" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 sm:px-8 sm:py-4 text-sm sm:text-base font-medium text-white bg-gradient-to-r from-brand-600 to-brand-700 rounded-full shadow-lg shadow-brand-500/25 hover:from-brand-700 hover:to-brand-800 transition-all duration-300">
                        Rezervă o vizită
                    </a>
                    <a href="services.php" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 sm:px-8 sm:py-4 text-sm sm:text-base font-medium text-brand-900 bg-white/80 border border-brand-200 rounded-full hover:bg-white transition-all duration-300 shadow-sm">
                        Vezi Serviciile
                    </a>
                </div>

                <!-- Stats Grid (1 col pe telefon, 3 pe tabletă/desktop) -->
                <div class="mt-8 sm:mt-12 pt-6 sm:pt-8 border-t border-brand-200/60 grid grid-cols-3 gap-2 sm:gap-6 text-center md:text-left">
                    <div>
                        <span class="block font-serif text-xl sm:text-3xl font-semibold text-brand-700">10+</span>
                        <span class="text-[10px] sm:text-xs text-nude-800/70 uppercase tracking-wider">Experiență</span>
                    </div>
                    <div>
                        <span class="block font-serif text-xl sm:text-3xl font-semibold text-brand-700">5k+</span>
                        <span class="text-[10px] sm:text-xs text-nude-800/70 uppercase tracking-wider">Clienți</span>
                    </div>
                    <div>
                        <span class="block font-serif text-xl sm:text-3xl font-semibold text-brand-700">4.9/5</span>
                        <span class="text-[10px] sm:text-xs text-nude-800/70 uppercase tracking-wider">Rating</span>
                    </div>
                </div>
            </div>

            <!-- Hero Image Banner -->
            <div class="md:col-span-1 lg:col-span-5 relative mt-6 md:mt-0">
                <div class="relative mx-auto max-w-sm sm:max-w-md lg:max-w-none">
                    <div class="aspect-[4/5] rounded-2xl sm:rounded-3xl img-hover-zoom shadow-rose-lg border-2 sm:border-4 border-white overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=1000&q=80" alt="Interior Salon Eternal Beauty" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-4 -left-4 sm:-bottom-6 sm:-left-6 bg-white/95 backdrop-blur-md p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-xl border border-brand-100 max-w-[200px] sm:max-w-xs hidden sm:block">
                        <div class="flex items-center gap-1 text-brand-500 mb-1 text-xs sm:text-sm">
                            ★★★★★
                        </div>
                        <p class="font-serif text-sm sm:text-lg font-semibold text-brand-950">Experiență Răsfățatoare</p>
                        <p class="text-[10px] sm:text-xs text-nude-800/70">Atmosferă relaxantă și servicii la nivel suprem.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- OFERTE SPECIALE (1 col pe telefon, 2 pe tabletă, 4 pe desktop) -->
<section class="py-12 sm:py-20 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-16">
            <span class="text-brand-600 font-semibold text-xs sm:text-sm tracking-widest uppercase">Pachete Exclusive</span>
            <h2 class="font-serif text-2xl sm:text-4xl lg:text-5xl font-semibold text-brand-950 mt-2 mb-3 sm:mb-4">Oferte Speciale de Sezon</h2>
            <div class="w-12 sm:w-16 h-1 bg-brand-400 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            <?php foreach (array_slice($offers, 0, 4) as $offer): ?>
                <div class="bg-rose-gradient rounded-2xl sm:rounded-3xl p-6 sm:p-8 border border-brand-100 shadow-rose flex flex-col justify-between hover:shadow-rose-lg transition-all duration-300">
                    <div>
                        <h3 class="font-serif text-xl sm:text-2xl font-semibold text-brand-950 mb-2 sm:mb-3"><?= eb_clean($offer['name']) ?></h3>
                        <div class="flex items-baseline gap-2 sm:gap-3 mb-3 sm:mb-4">
                            <span class="text-2xl sm:text-3xl font-serif font-bold text-brand-600"><?= eb_price($offer['price']) ?></span>
                            <span class="text-xs sm:text-sm text-nude-800/50 line-through"><?= eb_price($offer['old_price']) ?></span>
                        </div>
                        <p class="text-xs sm:text-sm text-nude-800/80 leading-relaxed mb-6">
                            <?= eb_clean($offer['description']) ?>
                        </p>
                    </div>
                    <a href="contact.php?service=<?= urlencode($offer['name']) ?>" class="w-full inline-flex items-center justify-center px-4 py-2.5 sm:py-3 text-xs sm:text-sm font-medium text-brand-900 bg-white rounded-full border border-brand-200 hover:bg-brand-600 hover:text-white transition-all shadow-sm">
                        Alege Pachetul
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- TESTIMONIALE (1 col pe mobil, 2 col pe tabletă/desktop) -->
<section class="py-12 sm:py-20 bg-brand-50/50 border-t border-brand-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-brand-600 font-semibold text-xs sm:text-sm tracking-widest uppercase">Gândurile Clienților</span>
        <h2 class="font-serif text-2xl sm:text-4xl lg:text-5xl font-semibold text-brand-950 mt-2 mb-8 sm:mb-12">Ce spun clienții noștri</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 text-left">
            <?php foreach (array_slice($testimonials, 0, 2) as $testi): ?>
                <div class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-rose border border-brand-100 flex flex-col justify-between">
                    <p class="font-serif text-base sm:text-lg italic text-brand-950 leading-relaxed mb-6">
                        "<?= eb_clean($testi['text']) ?>"
                    </p>
                    <div class="flex items-center justify-between border-t border-brand-100 pt-4">
                        <span class="font-medium text-brand-800 text-xs sm:text-sm uppercase tracking-wider">
                            <?= eb_clean($testi['name']) ?>
                        </span>
                        <div class="text-brand-500 text-xs sm:text-sm">
                            <?= eb_render_stars($testi['rating']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>