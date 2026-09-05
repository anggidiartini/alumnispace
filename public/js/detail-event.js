/* =========================================================
   public/js/event-detail.js
   Interaksi halaman detail event (upcoming/completed)
   ========================================================= */

document.addEventListener("DOMContentLoaded", () => {
  if (window.lucide) {
    lucide.createIcons();
  }

  initQuotaProgress();
  initRegistrationModal();
  initRegistrationForm();
  initScrollReveal();
  initGalleryRevealDelay();
});

/**
 * Mengisi angka kuota + animasi progress bar.
 * Hanya berjalan bila elemen #quota-progress ada di halaman
 * (yaitu saat status event = 'upcoming').
 */
function initQuotaProgress() {
  const progressBar = document.getElementById("quota-progress");
  if (!progressBar) return;

  const quota = parseInt(progressBar.dataset.quota, 10) || 0;
  const registered = parseInt(progressBar.dataset.registered, 10) || 0;
  const percentage = quota > 0 ? Math.round((registered / quota) * 100) : 0;
  const remaining = Math.max(quota - registered, 0);

  const quotaCount = document.getElementById("quota-count");
  const quotaHelper = document.getElementById("quota-helper");

  if (quotaCount) {
    quotaCount.textContent = `${registered} / ${quota}`;
  }

  if (quotaHelper) {
    quotaHelper.textContent =
      remaining > 0 ? `${remaining} kursi tersisa` : "Kuota sudah penuh";
  }

  requestAnimationFrame(() => {
    progressBar.style.width = `${percentage}%`;
  });

  const registerButton = document.getElementById("register-button");
  if (registerButton && remaining <= 0) {
    registerButton.disabled = true;
    registerButton.style.opacity = "0.6";
    registerButton.style.cursor = "not-allowed";
    registerButton.querySelector("span").textContent = "Kuota penuh";
  }
}

/**
 * Buka/tutup modal pendaftaran.
 * Hanya berjalan bila elemen modal ada di halaman
 * (yaitu saat status event = 'upcoming').
 */
function initRegistrationModal() {
  const modal = document.getElementById("registration-modal");
  const registerButton = document.getElementById("register-button");
  const closeButton = document.getElementById("modal-close-button");
  if (!modal || !registerButton || !closeButton) return;

  let lastFocusedElement = null;

  const openModal = () => {
    lastFocusedElement = document.activeElement;
    modal.classList.add("is-open");
    modal.setAttribute("aria-hidden", "false");
    closeButton.focus();
  };

  const closeModal = () => {
    modal.classList.remove("is-open");
    modal.setAttribute("aria-hidden", "true");
    if (lastFocusedElement) {
      lastFocusedElement.focus();
    }
  };

  registerButton.addEventListener("click", () => {
    if (registerButton.disabled) return;
    openModal();
  });

  closeButton.addEventListener("click", closeModal);

  modal.addEventListener("click", (event) => {
    if (event.target === modal) {
      closeModal();
    }
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && modal.classList.contains("is-open")) {
      closeModal();
    }
  });
}

/**
 * Submit form pendaftaran ke route event.register via fetch.
 * Hanya berjalan bila elemen form ada di halaman
 * (yaitu saat status event = 'upcoming').
 */
function initRegistrationForm() {
  const form = document.getElementById("registration-form");
  const registerButton = document.getElementById("register-button");
  const feedback = document.getElementById("registration-feedback");
  const submitButton = document.getElementById("registration-submit");
  if (!form || !registerButton) return;

  const actionUrl = registerButton.dataset.action;
  const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute("content");

  form.addEventListener("submit", async (event) => {
    event.preventDefault();

    if (!actionUrl) return;

    const formData = new FormData(form);
    const payload = {
      name: formData.get("name"),
      email: formData.get("email"),
    };

    setFeedback(feedback, "", null);
    submitButton.disabled = true;
    submitButton.style.opacity = "0.7";

    try {
      const response = await fetch(actionUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
          "X-CSRF-TOKEN": csrfToken || "",
        },
        body: JSON.stringify(payload),
      });

      if (!response.ok) {
        const errorBody = await safeJson(response);
        const message =
          errorBody?.message || "Pendaftaran gagal, silakan coba lagi.";
        setFeedback(feedback, message, "error");
        return;
      }

      setFeedback(feedback, "Pendaftaran berhasil! Sampai jumpa di acara.", "success");
      form.reset();
    } catch (error) {
      setFeedback(
        feedback,
        "Terjadi kesalahan jaringan, silakan coba lagi.",
        "error"
      );
    } finally {
      submitButton.disabled = false;
      submitButton.style.opacity = "1";
    }
  });
}

function setFeedback(element, message, type) {
  if (!element) return;
  element.textContent = message;
  element.classList.remove("is-success", "is-error");
  if (type === "success") element.classList.add("is-success");
  if (type === "error") element.classList.add("is-error");
}

async function safeJson(response) {
  try {
    return await response.json();
  } catch (error) {
    return null;
  }
}

/**
 * Animasi fade-in-up saat tiap section masuk viewport.
 */
function initScrollReveal() {
  const revealItems = document.querySelectorAll(".reveal");
  if (!revealItems.length) return;

  if (!("IntersectionObserver" in window)) {
    revealItems.forEach((item) => item.classList.add("is-visible"));
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-visible");
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.15, rootMargin: "0px 0px -40px 0px" }
  );

  revealItems.forEach((item) => observer.observe(item));
}

/**
 * Memberi delay bertahap pada tiap item galeri agar muncul berurutan.
 */
function initGalleryRevealDelay() {
  const galleryItems = document.querySelectorAll(".gallery-item.reveal");
  galleryItems.forEach((item, index) => {
    item.style.setProperty("--reveal-index", index);
  });
}