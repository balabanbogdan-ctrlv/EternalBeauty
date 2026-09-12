<?php
/**
 * Eternal Beauty — Funcții utilitare
 * Sanitizare, validare și helpere de randare, reutilizate în tot proiectul.
 */

declare(strict_types=1);

/**
 * Curăță un string venit de la utilizator și îl face sigur pentru afișare (anti-XSS).
 */
function eb_clean(string $value): string
{
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

/**
 * Validează o adresă de email.
 */
function eb_is_valid_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validează un număr de telefon moldovenesc/internațional simplu.
 */
function eb_is_valid_phone(string $phone): bool
{
    return (bool) preg_match('/^[0-9+\s()\-]{8,20}$/', $phone);
}

/**
 * Determină dacă fișierul curent corespunde unei rute din meniu, pentru starea "activ".
 */
function eb_is_active(string $file): bool
{
    return basename($_SERVER['SCRIPT_NAME']) === $file;
}

/**
 * Randează atributul class="active" dacă pagina curentă corespunde link-ului.
 */
function eb_active_class(string $file): string
{
    return eb_is_active($file) ? ' class="active"' : '';
}

/**
 * Generează un id sigur din text (pentru ancore / atribute data-).
 */
function eb_slug(string $text): string
{
    $text = mb_strtolower($text, 'UTF-8');
    $map  = ['ă' => 'a', 'â' => 'a', 'î' => 'i', 'ș' => 's', 'ş' => 's', 'ț' => 't', 'ţ' => 't'];
    $text = strtr($text, $map);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text) ?? $text;
    return trim($text, '-');
}

/**
 * Randează stelele de rating (1-5) ca markup SVG inline reutilizabil.
 */
function eb_render_stars(int $rating): string
{
    $rating = max(0, min(5, $rating));
    $out    = '<span class="stars" role="img" aria-label="' . $rating . ' din 5 stele">';
    for ($i = 1; $i <= 5; $i++) {
        $filled = $i <= $rating ? ' is-filled' : '';
        $out .= '<svg class="star' . $filled . '" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.5l2.9 6.2 6.8.7-5.1 4.6 1.5 6.7L12 17.6l-6.1 3.1 1.5-6.7-5.1-4.6 6.8-.7z"/></svg>';
    }
    return $out . '</span>';
}

/**
 * Formatează prețul salonului în mod consistent.
 */
function eb_price(int $value): string
{
    return number_format($value, 0, ',', ' ') . ' MDL';
}

/**
 * Validează complet datele formularului de programare.
 * Returnează un array de erori (gol dacă totul este valid).
 *
 * @param array<string,string> $data
 * @return array<string,string>
 */
function eb_validate_booking(array $data): array
{
    $errors = [];

    if (empty($data['first_name']) || mb_strlen($data['first_name']) < 2) {
        $errors['first_name'] = 'Te rugăm să introduci prenumele tău.';
    }

    if (empty($data['last_name']) || mb_strlen($data['last_name']) < 2) {
        $errors['last_name'] = 'Te rugăm să introduci numele tău.';
    }

    if (empty($data['phone']) || !eb_is_valid_phone($data['phone'])) {
        $errors['phone'] = 'Introdu un număr de telefon valid.';
    }

    if (empty($data['email']) || !eb_is_valid_email($data['email'])) {
        $errors['email'] = 'Introdu o adresă de email validă.';
    }

    if (empty($data['service'])) {
        $errors['service'] = 'Alege un serviciu dorit.';
    }

    if (empty($data['specialist'])) {
        $errors['specialist'] = 'Alege un specialist preferat.';
    }

    if (empty($data['date'])) {
        $errors['date'] = 'Alege data programării.';
    } else {
        $chosen = DateTime::createFromFormat('Y-m-d', $data['date']);
        $today  = new DateTime('today');
        if (!$chosen || $chosen < $today) {
            $errors['date'] = 'Alege o dată validă, începând cu ziua de azi.';
        }
    }

    if (empty($data['time'])) {
        $errors['time'] = 'Alege ora dorită.';
    }

    return $errors;
}

/**
 * Salvează o programare validă în fișierul de date (JSON), simulând persistența.
 * Structura este pregătită pentru a fi înlocuită ulterior cu inserții MySQL (prepared statements).
 *
 * @param array<string,string> $data
 */
function eb_save_booking(array $data): bool
{
    $bookings = [];
    if (file_exists(BOOKINGS_FILE)) {
        $raw      = file_get_contents(BOOKINGS_FILE);
        $bookings = json_decode($raw ?: '[]', true) ?: [];
    }

    $bookings[] = [
        'id'         => uniqid('bk_', true),
        'first_name' => $data['first_name'],
        'last_name'  => $data['last_name'],
        'phone'      => $data['phone'],
        'email'      => $data['email'],
        'service'    => $data['service'],
        'specialist' => $data['specialist'],
        'date'       => $data['date'],
        'time'       => $data['time'],
        'message'    => $data['message'] ?? '',
        'created_at' => date('Y-m-d H:i:s'),
    ];

    $dir = dirname(BOOKINGS_FILE);
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    return file_put_contents(
        BOOKINGS_FILE,
        json_encode($bookings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        LOCK_EX
    ) !== false;
}