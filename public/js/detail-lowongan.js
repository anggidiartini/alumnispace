document.addEventListener('DOMContentLoaded', () => {
  if (window.lucide) lucide.createIcons();

  // Catatan: toggle hamburger/menu mobile TIDAK lagi ditangani di sini —
  // sekarang halaman pakai <x-navbar />, jadi interaksi menu jadi
  // tanggung jawab komponen navbar itu sendiri.

  initSaveButton();
  initAccordions();
  initRevealOnScroll();
  initBackToTop();
  initWaBubble();
});

/* =========================================================
   Tombol simpan lowongan (disimpan di localStorage per slug)
   ========================================================= */
function initSaveButton() {
  const button = document.getElementById('save-button');
  if (!button) return;

  const slug = button.dataset.slug;
  const storageKey = 'saved-jobs';

  const getSaved = () => JSON.parse(localStorage.getItem(storageKey) || '[]');
  const setSaved = (list) => localStorage.setItem(storageKey, JSON.stringify(list));

  const isSaved = getSaved().includes(slug);
  toggleSavedUI(button, isSaved);

  button.addEventListener('click', () => {
    const saved = getSaved();
    const idx = saved.indexOf(slug);
    let nowSaved;

    if (idx === -1) {
      saved.push(slug);
      nowSaved = true;
    } else {
      saved.splice(idx, 1);
      nowSaved = false;
    }

    setSaved(saved);
    toggleSavedUI(button, nowSaved);
    showToast(nowSaved ? 'Lowongan tersimpan untuk nanti.' : 'Lowongan dihapus dari simpanan.');
  });
}

function toggleSavedUI(button, saved) {
  button.classList.toggle('saved', saved);
  button.setAttribute('aria-pressed', String(saved));
}

/* =========================================================
   Accordion (animasi tinggi halus lewat CSS grid-template-rows)
   ========================================================= */
function initAccordions() {
  document.querySelectorAll('.accordion-button').forEach((button) => {
    button.addEventListener('click', () => {
      const expanded = button.getAttribute('aria-expanded') === 'true';
      button.setAttribute('aria-expanded', String(!expanded));
    });
  });
}

/* =========================================================
   Reveal animasi saat section masuk viewport
   ========================================================= */
function initRevealOnScroll() {
  const items = document.querySelectorAll('.reveal-onscroll');
  if (!items.length) return;

  if (!('IntersectionObserver' in window)) {
    items.forEach((el) => el.classList.add('in-view'));
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.15, rootMargin: '0px 0px -40px 0px' }
  );

  items.forEach((el) => observer.observe(el));
}

/* =========================================================
   Tombol back-to-top
   ========================================================= */
function initBackToTop() {
  const backToTop = document.getElementById('back-to-top');
  if (!backToTop) return;

  window.addEventListener('scroll', () => {
    backToTop.classList.toggle('show', window.scrollY > 400);
  }, { passive: true });

  backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

/* =========================================================
   Bubble notifikasi WhatsApp (muncul otomatis + bisa ditutup)
   ========================================================= */
function initWaBubble() {
  const waButton = document.getElementById('wa-button');
  const waBubble = document.getElementById('wa-bubble');
  const waBubbleClose = document.getElementById('wa-bubble-close');
  if (!waButton || !waBubble || !waBubbleClose) return;

  const waTimer = window.setTimeout(() => waBubble.classList.add('show'), 1800);

  waButton.addEventListener('mouseenter', () => {
    window.clearTimeout(waTimer);
    waBubble.classList.add('show');
  });

  waBubbleClose.addEventListener('click', (event) => {
    event.preventDefault();
    waBubble.classList.remove('show');
  });
}

/* =========================================================
   Toast
   ========================================================= */
function showToast(message) {
  const toast = document.getElementById('toast');
  if (!toast) return;
  toast.textContent = message;
  toast.classList.add('show');
  window.setTimeout(() => toast.classList.remove('show'), 2800);
}