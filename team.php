<?php
$page_title = 'Echipa Noastră — Eternal Beauty';
require_once __DIR__ . '/includes/header.php';

$team_members = require __DIR__ . '/data/team.php';
?>

<!-- Banner Titlu -->
<section class="bg-rose-gradient py-12 sm:py-16 border-b border-brand-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-brand-600 font-semibold text-[10px] sm:text-xs tracking-widest uppercase">Specialiștii Noștri</span>
        <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-semibold text-brand-950 mt-2 mb-3 sm:mb-4">Echipa Eternal Beauty</h1>
        <p class="text-sm sm:text-base text-nude-800/80 max-w-2xl mx-auto font-light">Pasionați, calificați și atenți la detalii. Echipa noastră este pregătită să îți ofere o experiență de neuitat.</p>
    </div>
</section>

<!-- Grilă Membri Echipă -->
<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (!empty($team_members)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($team_members as $member): ?>
                    <div class="bg-nude-50/50 rounded-2xl sm:rounded-3xl border border-brand-100 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="aspect-3/4 w-full overflow-hidden relative bg-brand-100">
                                <img src="<?= eb_clean($member['image']) ?>" 
                                     alt="<?= eb_clean($member['name']) ?>" 
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                     loading="lazy">
                            </div>
                            
                            <div class="p-5 sm:p-6 text-center">
                                <h3 class="font-serif text-xl sm:text-2xl font-semibold text-brand-950"><?= eb_clean($member['name']) ?></h3>
                                <p class="text-xs font-semibold tracking-wider text-brand-600 uppercase mt-1 mb-3"><?= eb_clean($member['role']) ?></p>
                                
                                <?php if (!empty($member['bio'])): ?>
                                    <p class="text-xs text-nude-800/70 leading-relaxed"><?= eb_clean($member['bio']) ?></p>
                                <?php endif; ?>

                                <?php if (!empty($member['specialties']) && is_array($member['specialties'])): ?>
                                    <div class="mt-4 flex flex-wrap justify-center gap-1.5">
                                        <?php foreach ($member['specialties'] as $spec): ?>
                                            <span class="bg-white border border-brand-200 text-brand-800 text-[10px] px-2.5 py-1 rounded-full font-medium">
                                                <?= eb_clean($spec) ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="p-5 sm:p-6 pt-0 text-center">
                            <a href="contact.php?specialist=<?= urlencode($member['name']) ?>" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 text-xs font-semibold tracking-wider text-brand-800 uppercase bg-white rounded-full border border-brand-200 hover:bg-brand-600 hover:text-white hover:border-brand-600 transition-all shadow-xs">
                                Programează-te
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-nude-800/60">Nu există informații despre echipă în acest moment.</p>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>