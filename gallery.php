<?php
$page_title = 'Galerie Foto — Eternal Beauty';
require_once __DIR__ . '/includes/header.php';

$gallery_items = [
    ['title' => 'Coafură Elegantă de Seară', 'category' => 'Coafură', 'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80'],
    ['title' => 'Manichiură Rose Gold', 'category' => 'Manichiură', 'img' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80'],
    ['title' => 'Machiaj Profesional Nude', 'category' => 'Machiaj', 'img' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=800&q=80'],
    ['title' => 'Tratament Facial Glow', 'category' => 'Cosmetică', 'img' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=800&q=80'],
    ['title' => 'Colorare & Balayage', 'category' => 'Coafură', 'img' => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&w=800&q=80'],
    ['title' => 'Design Unghii de Sezon', 'category' => 'Manichiură', 'img' => 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80']
];
?>

<section class="bg-rose-gradient py-12 sm:py-16 border-b border-brand-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-brand-600 font-semibold text-[10px] sm:text-xs tracking-widest uppercase">Portofoliu</span>
        <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-semibold text-brand-950 mt-2 mb-3 sm:mb-4">Galerie Foto</h1>
        <p class="text-sm sm:text-base text-nude-800/80 max-w-2xl mx-auto font-light">O privire în lumea rafinamentului și a lucrărilor realizate de echipa noastră.</p>
    </div>
</section>

<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <?php foreach ($gallery_items as $item): ?>
                <div class="group relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-rose border border-brand-100 aspect-4/3 bg-brand-50">
                    <img src="<?= $item['img'] ?>" alt="<?= eb_clean($item['title']) ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-950/80 via-brand-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 sm:p-6 text-white">
                        <span class="text-[10px] uppercase tracking-widest text-brand-300 font-medium"><?= eb_clean($item['category']) ?></span>
                        <h3 class="font-serif text-lg sm:text-xl font-semibold mt-1"><?= eb_clean($item['title']) ?></h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>