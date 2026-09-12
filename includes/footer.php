<?php
/**
 * Eternal Beauty — Footer
 */
?>
</main> <!-- Închiderea tag-ului main deschis în header.php -->

<footer class="bg-brand-950 text-white pt-12 pb-8 border-t border-brand-900 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            
            <!-- Despre Salon -->
            <div class="space-y-4">
                <a href="index.php" class="font-serif text-2xl font-semibold tracking-wide text-white block">
                    <?= eb_clean(SITE_NAME) ?><span class="text-brand-500">.</span>
                </a>
                <p class="text-xs text-brand-200/80 leading-relaxed font-light">
                    Oazele tale de liniște și rafinament. Oferim servicii premium de frumusețe, adaptate stilului și dorințelor tale.
                </p>
                <!-- Rețele Sociale -->
                <div class="flex items-center gap-3 pt-2">
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-brand-900 flex items-center justify-center text-brand-200 hover:bg-brand-600 hover:text-white transition-all shadow-xs" aria-label="Facebook">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-brand-900 flex items-center justify-center text-brand-200 hover:bg-brand-600 hover:text-white transition-all shadow-xs" aria-label="Instagram">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Navigație Rapidă -->
            <div>
                <h3 class="font-serif text-lg font-semibold text-white mb-4">Navigație</h3>
                <ul class="grid grid-cols-2 gap-x-4 gap-y-2.5 text-xs">
                    <?php foreach ($GLOBALS['nav_links'] as $file => $label): ?>
                        <li>
                            <a href="<?= $file ?>" class="text-brand-200/80 hover:text-brand-300 transition-colors flex items-center gap-1.5">
                                <span class="text-brand-500 text-[10px]">›</span>
                                <?= eb_clean($label) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Program de Lucru Dinamic -->
            <div>
                <h3 class="font-serif text-lg font-semibold text-white mb-4">Program</h3>
                <ul class="space-y-2 text-xs text-brand-200/80">
                    <?php foreach ($GLOBALS['business_hours'] as $days => $hours): ?>
                        <li class="flex justify-between border-b border-brand-900/60 pb-1.5 last:border-0">
                            <span><?= eb_clean($days) ?>:</span>
                            <span class="<?= $hours === 'Închis' ? 'text-brand-400 font-medium' : 'font-medium text-white' ?>">
                                <?= eb_clean($hours) ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="font-serif text-lg font-semibold text-white mb-4">Contact</h3>
                <ul class="space-y-2.5 text-xs text-brand-200/80">
                    <li class="flex items-start gap-2">
                        <span class="text-brand-400">📍</span>
                        <span><?= eb_clean(SITE_ADDRESS) ?></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-brand-400">📞</span>
                        <a href="tel:<?= preg_replace('/[^0-9+]/', '', SITE_PHONE) ?>" class="hover:text-brand-300 transition-colors">
                            <?= eb_clean(SITE_PHONE) ?>
                        </a>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-brand-400">✉️</span>
                        <a href="mailto:<?= eb_clean(SITE_EMAIL) ?>" class="hover:text-brand-300 transition-colors">
                            <?= eb_clean(SITE_EMAIL) ?>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="pt-6 border-t border-brand-900/80 text-center text-[11px] text-brand-300/60 flex flex-col sm:flex-row justify-between items-center gap-2">
            <p>&copy; <?= date('Y') ?> <?= eb_clean(SITE_NAME) ?>. Toate drepturile rezervate.</p>
            <p class="font-light">Proiect realizat pentru concurs.</p>
        </div>
    </div>
</footer>

</body>
</html>