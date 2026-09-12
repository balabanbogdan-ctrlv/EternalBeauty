<?php
$page_title = 'Recenzii & Păreri — Eternal Beauty';
require_once __DIR__ . '/includes/header.php';

// Calea către fișierul JSON/PHP unde sunt stocate recenziile
$reviews_file = __DIR__ . '/data/reviews.json';

// Mesaje de confirmare sau eroare
$success_msg = '';
$error_msg = '';

// Procesarea formularului când utilizatorul trimite o recenzie
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $rating = (int)($_POST['rating'] ?? 5);
    $comment = trim($_POST['comment'] ?? '');

    // Validare simplă
    if (empty($name) || empty($comment)) {
        $error_msg = 'Te rugăm să completezi numele și mesajul tau.';
    } elseif ($rating < 1 || $rating > 5) {
        $error_msg = 'Evaluarea trebuie să fie între 1 și 5 stele.';
    } else {
        // Citire recenzii existente
        $existing_reviews = [];
        if (file_exists($reviews_file)) {
            $json_data = file_get_contents($reviews_file);
            $existing_reviews = json_decode($json_data, true) ?? [];
        }

        // Structura noii recenzii
        $new_review = [
            'id' => time(),
            'name' => $name,
            'service' => $service ?: 'Servicii Generale',
            'rating' => $rating,
            'comment' => $comment,
            'date' => date('d.m.Y')
        ];

        // Adăugare la începutul listei
        array_unshift($existing_reviews, $new_review);

        // Salvare în fișierul JSON
        if (file_put_contents($reviews_file, json_encode($existing_reviews, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
            $success_msg = 'Îți mulțumim! Recenzia ta a fost adăugată cu succes.';
        } else {
            $error_msg = 'A apărut o eroare la salvarea recenziei. Te rugăm să încerci din nou.';
        }
    }
}

// Preluarea listei de recenzii (din JSON sau din fișierul implicit PHP)
$reviews = [];
if (file_exists($reviews_file)) {
    $reviews = json_decode(file_get_contents($reviews_file), true) ?? [];
} else {
    // Dacă nu există JSON-ul încă, încărcăm datele implicite din data/reviews.php
    if (file_exists(__DIR__ . '/data/reviews.php')) {
        $reviews = require __DIR__ . '/data/reviews.php';
    }
}
?>

<!-- Banner Titlu -->
<section class="bg-rose-gradient py-12 sm:py-16 border-b border-brand-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-brand-600 font-semibold text-[10px] sm:text-xs tracking-widest uppercase">Ce spun clienții noștri</span>
        <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-semibold text-brand-950 mt-2 mb-3 sm:mb-4">Recenzii & Impresii</h1>
        <p class="text-sm sm:text-base text-nude-800/80 max-w-2xl mx-auto font-light">Fiecare experiență la Eternal Beauty este unică. Citește părerile clientelor noastre sau lasă-ne un feedback.</p>
    </div>
</section>

<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Coloana Stânga: Formular adăugare recenzie -->
            <div class="lg:col-span-1 bg-nude-50/60 rounded-2xl sm:rounded-3xl p-6 sm:p-8 border border-brand-100 shadow-sm h-fit">
                <h2 class="font-serif text-2xl font-semibold text-brand-950 mb-2">Lasă o recenzie</h2>
                <p class="text-xs text-nude-800/70 mb-6">Părerea ta ne ajută să ne menținem serviciile la cele mai înalte standarde.</p>

                <?php if ($success_msg): ?>
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl">
                        <?= eb_clean($success_msg) ?>
                    </div>
                <?php endif; ?>

                <?php if ($error_msg): ?>
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-xl">
                        <?= eb_clean($error_msg) ?>
                    </div>
                <?php endif; ?>

                <form action="reviews.php" method="POST" class="space-y-4">
                    <div>
                        <label for="name" class="block text-xs font-semibold text-brand-900 mb-1">Numele Tău *</label>
                        <input type="text" id="name" name="name" required class="w-full px-4 py-2.5 text-xs bg-white border border-brand-200 rounded-xl focus:outline-none focus:border-brand-600 transition-colors">
                    </div>

                    <div>
                        <label for="service" class="block text-xs font-semibold text-brand-900 mb-1">Serviciul Beneficiat</label>
                        <input type="text" id="service" name="service" placeholder="ex: Coafură, Manichiură, Machiaj" class="w-full px-4 py-2.5 text-xs bg-white border border-brand-200 rounded-xl focus:outline-none focus:border-brand-600 transition-colors">
                    </div>

                    <div>
                        <label for="rating" class="block text-xs font-semibold text-brand-900 mb-1">Evaluare (Stele)</label>
                        <select id="rating" name="rating" class="w-full px-4 py-2.5 text-xs bg-white border border-brand-200 rounded-xl focus:outline-none focus:border-brand-600 transition-colors">
                            <option value="5">⭐⭐⭐⭐⭐ (5/5 - Excelent)</option>
                            <option value="4">⭐⭐⭐⭐ (4/5 - Foarte Bine)</option>
                            <option value="3">⭐⭐⭐ (3/3 - Satisfăcător)</option>
                            <option value="2">⭐⭐ (2/5 - Slab)</option>
                            <option value="1">⭐ (1/5 - Nesatisfăcător)</option>
                        </select>
                    </div>

                    <div>
                        <label for="comment" class="block text-xs font-semibold text-brand-900 mb-1">Mesajul Tău *</label>
                        <textarea id="comment" name="comment" rows="4" required class="w-full px-4 py-2.5 text-xs bg-white border border-brand-200 rounded-xl focus:outline-none focus:border-brand-600 transition-colors resize-none" placeholder="Descrie experiența ta..."></textarea>
                    </div>

                    <button type="submit" class="w-full py-3 px-6 text-xs font-semibold tracking-wider text-white bg-gradient-to-r from-brand-600 to-brand-700 rounded-full hover:from-brand-700 hover:to-brand-800 transition-all shadow-md">
                        Trimite Recenzia
                    </button>
                </form>
            </div>

            <!-- Coloana Dreapta: Lista de recenzii -->
            <div class="lg:col-span-2 space-y-6">
                <?php if (!empty($reviews)): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <?php foreach ($reviews as $rev): ?>
                            <div class="bg-nude-50/40 border border-brand-100 rounded-2xl p-6 flex flex-col justify-between shadow-xs hover:shadow-sm transition-shadow">
                                <div>
                                    <!-- Stele -->
                                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-sm">
                                        <?php for ($i = 0; $i < (int)($rev['rating'] ?? 5); $i++): ?>
                                            ★
                                        <?php endfor; ?>
                                    </div>
                                    
                                    <!-- Comentariu -->
                                    <p class="text-xs text-nude-800/80 italic leading-relaxed mb-4">"<?= eb_clean($rev['comment']) ?>"</p>
                                </div>

                                <div class="pt-3 border-t border-brand-100/60 flex justify-between items-center text-[10px] text-nude-800/60">
                                    <div>
                                        <span class="font-semibold text-brand-900 text-xs block"><?= eb_clean($rev['name']) ?></span>
                                        <span class="text-brand-600 font-medium"><?= eb_clean($rev['service']) ?></span>
                                    </div>
                                    <span class="text-gray-400"><?= eb_clean($rev['date']) ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-center text-nude-800/60 py-12">Fii prima persoană care lasă o recenzie!</p>
                <?php endif; ?>
            </div>

        </div>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>