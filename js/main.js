/**
 * Eternal Beauty — Interactivitate Frontend & EmailJS Integration
 */

// Funcții globale meniu mobil
window.openMenu = function() {
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileOverlay = document.getElementById('mobileOverlay');
    const navToggle = document.getElementById('navToggle');

    if (!mobileMenu || !mobileOverlay) return;

    mobileOverlay.classList.remove('hidden');
    setTimeout(() => {
        mobileOverlay.classList.remove('opacity-0');
        mobileMenu.classList.remove('translate-x-full');
    }, 10);
    document.body.classList.add('overflow-hidden');
    if (navToggle) navToggle.setAttribute('aria-expanded', 'true');
    mobileMenu.setAttribute('aria-hidden', 'false');
};

window.closeMenu = function() {
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileOverlay = document.getElementById('mobileOverlay');
    const navToggle = document.getElementById('navToggle');

    if (!mobileMenu || !mobileOverlay) return;

    mobileOverlay.classList.add('opacity-0');
    mobileMenu.classList.add('translate-x-full');
    setTimeout(() => {
        mobileOverlay.classList.add('hidden');
    }, 300);
    document.body.classList.remove('overflow-hidden');
    if (navToggle) navToggle.setAttribute('aria-expanded', 'false');
    mobileMenu.setAttribute('aria-hidden', 'true');
};

document.addEventListener('DOMContentLoaded', () => {
    // Event listeners meniu
    const navToggle = document.getElementById('navToggle');
    const mobileClose = document.getElementById('mobileClose');
    const mobileOverlay = document.getElementById('mobileOverlay');

    if (navToggle) navToggle.addEventListener('click', window.openMenu);
    if (mobileClose) mobileClose.addEventListener('click', window.closeMenu);
    if (mobileOverlay) mobileOverlay.addEventListener('click', window.closeMenu);

    // Navbar Effect la Scroll
    const navEl = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 30) {
            navEl?.classList.add('shadow-md');
        } else {
            navEl?.classList.remove('shadow-md');
        }
    });

    // Procesare Formular Programare (PHP Save + EmailJS Notification)
    const appointmentForm = document.getElementById('appointmentForm');
    const formStatus = document.getElementById('formStatus');

    if (appointmentForm) {
        appointmentForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            const originalBtnText = submitBtn ? submitBtn.innerText : 'Confirmă Programarea';

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerText = 'Se procesează...';
            }

            const formData = new FormData(appointmentForm);

            // Pasul 1: Salvarea rezervării pe server (în JSON)
            fetch('contact.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Pasul 2: Trimitem e-mailul de confirmare prin EmailJS
                    const serviceID = 'service_7c9fvol';
                    const templateID = 'template_hayalaj';

                    emailjs.sendForm(serviceID, templateID, appointmentForm)
                        .then(() => {
                            if (formStatus) {
                                formStatus.classList.remove('hidden', 'bg-red-100', 'text-red-700');
                                formStatus.classList.add('bg-green-100', 'text-green-800');
                                formStatus.innerText = 'Programare înregistrată! Un e-mail de confirmare a fost trimis cu succes.';
                            }
                            appointmentForm.reset();
                        })
                        .catch((emailErr) => {
                            console.error('Eroare EmailJS:', emailErr);
                            if (formStatus) {
                                formStatus.classList.remove('hidden', 'bg-red-100', 'text-red-700');
                                formStatus.classList.add('bg-green-100', 'text-green-800');
                                formStatus.innerText = 'Programarea a fost salvată pe server, dar trimiterea email-ului a eșuat.';
                            }
                        });
                } else {
                    if (formStatus) {
                        formStatus.classList.remove('hidden', 'bg-green-100', 'text-green-800');
                        formStatus.classList.add('bg-red-100', 'text-red-700');
                        formStatus.innerText = data.error || 'Eroare la procesarea rezervării. Încearcă din nou.';
                    }
                }
            })
            .catch((error) => {
                console.error('Eroare rețea:', error);
                if (formStatus) {
                    formStatus.classList.remove('hidden', 'bg-green-100', 'text-green-800');
                    formStatus.classList.add('bg-red-100', 'text-red-700');
                    formStatus.innerText = 'A apărut o eroare de conexiune. Vă rugăm să încercați din nou.';
                }
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerText = originalBtnText;
                }
            });
        });
    }
});