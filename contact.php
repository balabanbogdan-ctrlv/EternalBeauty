<?php
/**
 * Eternal Beauty — Pagina de Contact & Programări
 */

declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

// Procesare AJAX / POST Formular
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $is_ajax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

    $booking_data = [
        'name'       => trim($_POST['user_name'] ?? ''),
        'email'      => trim($_POST['user_email'] ?? ''),
        'phone'      => trim($_POST['user_phone'] ?? ''),
        'service'    => trim($_POST['service_name'] ?? ''),
        'specialist' => trim($_POST['specialist_name'] ?? ''),
        'date'       => trim($_POST['booking_date'] ?? ''),
        'time'       => trim($_POST['booking_time'] ?? ''),
        'notes'      => trim($_POST['message'] ?? ''),
    ];

    if (empty($booking_data['name']) || empty($booking_data['email']) || empty($booking_data['phone']) || empty($booking_data['service'])) {
        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Vă rugăm să completați toate câmpurile obligatorii.']);
            exit;
        }
        $error_message = 'Vă rugăm să completați toate câmpurile obligatorii.';
    } else {
        $saved = eb_save_booking($booking_data);

        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode(['success' => (bool)$saved]);
            exit;
        }
        $success_message = 'Programarea dumneavoastră a fost înregistrată cu succes!';
    }
}

$page_title = 'Contact & Programări — Eternal Beauty';
require_once __DIR__ . '/includes/header.php';

// Preluare parametri transmisi din URL
$selected_service = $_GET['service'] ?? $_GET['category'] ?? '';
$selected_specialist = $_GET['specialist'] ?? '';
?>

<section class="py-12 sm:py-16 bg-gradient-to-b from-white to-brand-50/30">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-semibold text-brand-950 mb-3">
                Programare Online
            </h1>
            <p class="text-xs sm:text-sm text-nude-800/80 leading-relaxed font-light">
                Alege serviciul dorit, data și ora potrivită, iar noi îți vom confirma rezervarea direct pe e-mail.
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-brand-100/60 p-6 sm:p-10">
            <?php if (!empty($success_message)): ?>
                <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-800 text-sm text-center font-medium">
                    <?= eb_clean($success_message) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error_message)): ?>
                <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-700 text-sm text-center font-medium">
                    <?= eb_clean($error_message) ?>
                </div>
            <?php endif; ?>

            <form id="appointmentForm" method="POST" action="contact.php" class="space-y-5">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Nume Client -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-900 mb-1.5">
                            Nume și Prenume <span class="text-brand-600">*</span>
                        </label>
                        <input type="text" name="user_name" required placeholder="ex: Ana Popescu" 
                               class="w-full px-4 py-3 rounded-xl border border-brand-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none text-xs sm:text-sm transition-all">
                    </div>

                    <!-- Email Client -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-900 mb-1.5">
                            Adresă Email <span class="text-brand-600">*</span>
                        </label>
                        <input type="email" name="user_email" required placeholder="ex: ana@example.com" 
                               class="w-full px-4 py-3 rounded-xl border border-brand-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none text-xs sm:text-sm transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Telefon -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-900 mb-1.5">
                            Număr Telefon <span class="text-brand-600">*</span>
                        </label>
                        <input type="tel" name="user_phone" required placeholder="ex: 069123456" 
                               class="w-full px-4 py-3 rounded-xl border border-brand-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none text-xs sm:text-sm transition-all">
                    </div>

                    <!-- Specialist Preferat -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-900 mb-1.5">
                            Specialist (Opțional)
                        </label>
                        <input type="text" name="specialist_name" value="<?= eb_clean($selected_specialist) ?>" placeholder="ex: Elena Rotari" 
                               class="w-full px-4 py-3 rounded-xl border border-brand-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none text-xs sm:text-sm transition-all">
                    </div>
                </div>

                <!-- Serviciu Dorit -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-900 mb-1.5">
                        Serviciul Solicitat <span class="text-brand-600">*</span>
                    </label>
                    <input type="text" name="service_name" value="<?= eb_clean($selected_service) ?>" required placeholder="ex: Coafură Eternal / Manichiură" 
                           class="w-full px-4 py-3 rounded-xl border border-brand-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none text-xs sm:text-sm transition-all">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Data -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-900 mb-1.5">
                            Data Programării <span class="text-brand-600">*</span>
                        </label>
                        <input type="date" name="booking_date" required 
                               class="w-full px-4 py-3 rounded-xl border border-brand-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none text-xs sm:text-sm transition-all">
                    </div>

                    <!-- Ora -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brand-900 mb-1.5">
                            Ora Preferată <span class="text-brand-600">*</span>
                        </label>
                        <input type="time" name="booking_time" required 
                               class="w-full px-4 py-3 rounded-xl border border-brand-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none text-xs sm:text-sm transition-all">
                    </div>
                </div>

                <!-- Mesaj / Observații -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-brand-900 mb-1.5">
                        Observații sau Cerințe Speciale
                    </label>
                    <textarea name="message" rows="3" placeholder="Mențiuni speciale sau alte detalii..." 
                              class="w-full px-4 py-3 rounded-xl border border-brand-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none text-xs sm:text-sm transition-all resize-none"></textarea>
                </div>

                <!-- Mesaj Status (Răspuns JS) -->
                <div id="formStatus" class="hidden p-4 rounded-xl text-xs sm:text-sm text-center font-medium"></div>

                <!-- Buton Trimitere -->
                <button type="submit" id="submitBtn" 
                        class="w-full py-4 px-8 rounded-full bg-gradient-to-r from-brand-600 to-brand-700 text-white font-medium text-sm sm:text-base shadow-lg shadow-brand-500/25 hover:from-brand-700 hover:to-brand-800 transition-all duration-200">
                    Confirmă Programarea
                </button>
            </form>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>