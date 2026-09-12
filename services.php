<?php
$page_title = 'Servicii și Tarife — Eternal Beauty';
require_once __DIR__ . '/includes/header.php';

$services = require __DIR__ . '/data/services.php';
?>

<section class="bg-rose-gradient py-12 sm:py-16 border-b border-brand-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-brand-600 font-semibold text-[10px] sm:text-xs tracking-widest uppercase">Lista Noastră Exclusivă</span>
        <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-semibold text-brand-950 mt-2 mb-3 sm:mb-4">Servicii & Tarife</h1>
        <p class="text-sm sm:text-base text-nude-800/80 max-w-2xl mx-auto font-light">Alege serviciul dorit și lasă-te pe mâna specialiștilor noștri dedicați frumuseții tale.</p>
    </div>
</section>

<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (!empty($services)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php foreach ($services as $key => $category): ?>
                    <div class="bg-nude-50/60 rounded-2xl sm:rounded-3xl p-6 sm:p-8 border border-brand-100 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="border-b border-brand-200 pb-3 mb-4 sm:mb-6 flex justify-between items-center">
                                <h2 class="font-serif text-xl sm:text-2xl font-semibold text-brand-950"><?= eb_clean($category['label']) ?></h2>
                            </div>
                            
                            <div class="space-y-4 sm:space-y-6">
                                <?php foreach ($category['items'] as $item): ?>
                                    <div class="flex justify-between items-start gap-3 border-b border-brand-100/50 pb-3 last:border-0">
                                        <div>
                                            <h3 class="font-medium text-brand-900 text-sm sm:text-base"><?= eb_clean($item['name']) ?></h3>
                                            <?php if (!empty($item['description'])): ?>
                                                <p class="text-xs text-nude-800/70 mt-0.5 leading-snug"><?= eb_clean($item['description']) ?></p>
                                            <?php endif; ?>
                                            <?php if (!empty($item['duration'])): ?>
                                                <span class="text-[10px] sm:text-xs text-brand-600 font-medium block mt-1">⏱ Durată: <?= eb_clean($item['duration']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <span class="font-serif font-semibold text-brand-700 text-base sm:text-lg whitespace-nowrap">
                                            <?= eb_price((int)$item['price']) ?>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-brand-100">
                            <a href="contact.php?category=<?= urlencode($category['label']) ?>" class="w-full inline-flex items-center justify-center px-4 py-2.5 text-xs font-semibold tracking-wider text-brand-800 uppercase bg-white rounded-full border border-brand-200 hover:bg-brand-600 hover:text-white transition-all shadow-xs">
                                Programare <?= eb_clean($category['label']) ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-nude-800/60">Nu există servicii disponibile în acest moment.</p>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>