document.addEventListener('DOMContentLoaded', () => {
  if (window.lucide) lucide.createIcons();

  initMobileMenu();
  initSaveButton();
  initScrollToApply();
  initAccordions();
  initRevealOnScroll();
  initApplicationForm();
});

/* =========================================================
   1. Menu mobile
   ========================================================= */
function initMobileMenu() {
  const toggle = document.getElementById('menu-toggle');
  const menu = document.getElementById('mobile-menu');
  if (!toggle || !menu) return;

  toggle.addEventListener('click', () => {
    const open = menu.classList.toggle('open');
    toggle.setAttribute('aria-expanded', String(open));
    toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
  });
}

/* =========================================================
   2. Tombol simpan lowongan (disimpan di localStorage per slug)
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
   3. Scroll halus ke form lamaran
   ========================================================= */
function initScrollToApply() {
  document.querySelectorAll('[data-scroll-apply]').forEach((button) => {
    button.addEventListener('click', () => {
      const target = document.getElementById('lamar');
      if (!target) return;
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      window.setTimeout(() => {
        document.getElementById('cover-letter')?.focus({ preventScroll: true });
      }, 550);
    });
  });
}

/* =========================================================
   4. Accordion (animasi tinggi halus lewat CSS grid-template-rows)
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
   5. Reveal animasi lambat saat section masuk viewport
   ========================================================= */
function initRevealOnScroll() {
  const items = document.querySelectorAll('.reveal');
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
   6. Form lamaran — cover_letter + portfolio_url saja
      (menyesuaikan JobVacancyController::apply, applicant
      diambil dari user yang sedang login di server)
   ========================================================= */
function initApplicationForm() {
  const form = document.getElementById('application-form');
  if (!form) return;

  const coverLetterField = document.getElementById('cover-letter');
  const portfolioField = document.getElementById('portfolio-url');

  ['cover-letter', 'portfolio-url'].forEach((id) => {
    const field = document.getElementById(id);
    if (!field) return;
    field.addEventListener('input', () => clearError(id));
    field.addEventListener('change', () => clearError(id));
  });

  form.addEventListener('submit', async (event) => {
    event.preventDefault();

    // Belum login -> jangan submit, arahkan ke halaman login
    if (form.dataset.authenticated === '0') {
      window.location.href = form.dataset.loginUrl;
      return;
    }

    clearError('cover-letter');
    clearError('portfolio-url');
    let valid = true;

    const coverLetter = coverLetterField.value.trim();
    const portfolioUrl = portfolioField.value.trim();

    if (coverLetter.length > 2000) {
      setError('cover-letter');
      valid = false;
    }

    if (portfolioUrl) {
      try {
        new URL(portfolioUrl);
      } catch {
        setError('portfolio-url');
        valid = false;
      }
    }

    const status = document.getElementById('form-status');

    if (!valid) {
      status.textContent = 'Periksa kembali field yang diberi tanda.';
      status.classList.remove('hidden');
      return;
    }

    const submitButton = document.getElementById('submit-application');
    submitButton.disabled = true;
    status.textContent = 'Mengirim lamaran...';
    status.classList.remove('hidden');

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    const applyUrl = form.dataset.applyUrl;

    try {
      const response = await fetch(applyUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken || '',
          'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({
          cover_letter: coverLetter,
          portfolio_url: portfolioUrl,
        }),
      });

      const result = await response.json().catch(() => ({}));

      if (response.status === 401) {
        window.location.href = result.redirect || form.dataset.loginUrl;
        return;
      }

      if (response.ok) {
        document.getElementById('application-form-wrap').classList.add('hidden');
        const success = document.getElementById('success-state');
        success.classList.remove('hidden');
        if (window.lucide) lucide.createIcons();
        success.scrollIntoView({ behavior: 'smooth', block: 'center' });
      } else if (response.status === 422 && result.errors) {
        applyServerErrors(result.errors);
        status.textContent = 'Periksa kembali field yang diberi tanda.';
      } else {
        status.textContent = result.message || 'Lamaran belum terkirim. Silakan coba lagi.';
      }
    } catch (error) {
      status.textContent = 'Terjadi kesalahan jaringan. Silakan coba lagi.';
    } finally {
      submitButton.disabled = false;
    }
  });
}

function applyServerErrors(errors) {
  const map = {
    cover_letter: 'cover-letter',
    portfolio_url: 'portfolio-url',
  };
  Object.keys(errors).forEach((key) => {
    const id = map[key];
    if (id) setError(id);
  });
}

function clearError(fieldId) {
  document.getElementById(fieldId)?.closest('.form-field')?.classList.remove('has-error');
}

function setError(fieldId) {
  document.getElementById(fieldId)?.closest('.form-field')?.classList.add('has-error');
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