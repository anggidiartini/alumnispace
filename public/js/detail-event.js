/* =========================================================
   detail-event.js
   Interaktivitas + animasi untuk resources/views/event/detail.blade.php
   Konfigurasi dibaca dari window.EventDetailConfig (di-print oleh Blade).

   Catatan: menu mobile / hamburger TIDAK ditangani di sini lagi —
   itu sudah jadi tanggung jawab komponen <x-navbar /> (sama seperti
   event.blade.php & lowongan.blade.php), jadi tidak ada duplikasi
   toggle menu di halaman ini.
   ========================================================= */

(function () {
  "use strict";

  const config = window.EventDetailConfig || {};
  const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ---------- Reveal saat scroll (fade + slide/scale bertahap per section) ---------- */

  function initScrollReveal() {
    const revealEls = document.querySelectorAll("[data-reveal]");
    if (!revealEls.length) return;

    if (prefersReducedMotion || !("IntersectionObserver" in window)) {
      revealEls.forEach(function (el) { el.classList.add("is-visible"); });
      return;
    }

    const observer = new IntersectionObserver(
      function (entries, obs) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            obs.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15, rootMargin: "0px 0px -60px 0px" }
    );

    revealEls.forEach(function (el, index) {
      el.style.setProperty("--reveal-delay", Math.min(index * 0.08, 0.5) + "s");
      observer.observe(el);
    });
  }

  initScrollReveal();

  /* ---------- Stagger animasi tag & galeri (delay per item lewat CSS var) ---------- */

  document.querySelectorAll(".tag-list .tag").forEach(function (tag, index) {
    tag.style.setProperty("--tag-delay", (0.15 + index * 0.08) + "s");
  });

  document.querySelectorAll(".gallery-grid .gallery-item").forEach(function (item, index) {
    item.style.setProperty("--gallery-delay", (index * 0.08) + "s");
  });

  /* ---------- Tilt lembut pada gambar hero mengikuti gerakan mouse ---------- */

  const heroMedia = document.querySelector(".hero-media");

  if (heroMedia && !prefersReducedMotion && window.matchMedia("(hover: hover)").matches) {
    heroMedia.addEventListener("mousemove", function (event) {
      const rect = heroMedia.getBoundingClientRect();
      const x = (event.clientX - rect.left) / rect.width - 0.5;
      const y = (event.clientY - rect.top) / rect.height - 0.5;
      heroMedia.style.transform = "rotateY(" + (x * 6) + "deg) rotateX(" + (y * -6) + "deg)";
    });

    heroMedia.addEventListener("mouseleave", function () {
      heroMedia.style.transform = "rotateY(0deg) rotateX(0deg)";
    });
  }

  /* ---------- Efek ripple saat tombol utama ditekan ---------- */

  document.querySelectorAll(".primary-button").forEach(function (btn) {
    btn.addEventListener("click", function (event) {
      if (prefersReducedMotion) return;
      const rect = btn.getBoundingClientRect();
      const ripple = document.createElement("span");
      const size = Math.max(rect.width, rect.height);
      ripple.className = "ripple";
      ripple.style.width = ripple.style.height = size + "px";
      ripple.style.left = (event.clientX - rect.left - size / 2) + "px";
      ripple.style.top = (event.clientY - rect.top - size / 2) + "px";
      btn.appendChild(ripple);
      window.setTimeout(function () { ripple.remove(); }, 650);
    });
  });

  /* ---------- Animasi hitung angka naik (dipakai untuk kuota) ---------- */

  function animateCount(el, from, to, duration) {
    if (prefersReducedMotion || from === to) {
      el.textContent = to;
      return;
    }
    const start = performance.now();
    function tick(now) {
      const progress = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const current = Math.round(from + (to - from) * eased);
      el.textContent = current;
      if (progress < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }

  /* ---------- Animasi progress bar kuota + angka saat halaman dimuat ---------- */

  function animateOnLoad() {
    document.querySelectorAll(".progress-fill[data-target-width]").forEach(function (bar) {
      const target = bar.getAttribute("data-target-width") || "0%";
      requestAnimationFrame(function () {
        bar.style.width = target;
      });
    });

    const registered = Number(config.registered || 0);
    document.querySelectorAll("[data-role='animated-number']").forEach(function (el) {
      animateCount(el, 0, registered, 900);
    });
  }

  window.setTimeout(animateOnLoad, 150);

  /* ---------- Toast ---------- */

  const toast = document.getElementById("toast");
  let toastTimer;

  function showToast(message, isError) {
    if (!toast) return;
    toast.textContent = message;
    toast.classList.toggle("is-error", Boolean(isError));
    toast.classList.add("is-visible");
    window.clearTimeout(toastTimer);
    toastTimer = window.setTimeout(function () {
      toast.classList.remove("is-visible");
    }, 3200);
  }

  /* ---------- Update tampilan kuota setelah pendaftaran berhasil ---------- */

  function updateQuotaDisplay(registeredCount, quota) {
    const quotaCountEl = document.querySelector("[data-role='quota-count']");
    const remainingEl = document.querySelector("[data-role='remaining-count']");
    const infoQuotaEl = document.querySelector("[data-role='info-quota']");
    const progressFillEl = document.querySelector(".progress-fill");

    const remaining = Math.max(quota - registeredCount, 0);
    const percent = quota > 0 ? Math.min(100, Math.round((registeredCount / quota) * 100)) : 0;

    if (quotaCountEl) quotaCountEl.textContent = registeredCount + " / " + quota;
    if (infoQuotaEl) infoQuotaEl.textContent = registeredCount + " dari " + quota + " peserta";
    if (remainingEl) {
      remainingEl.textContent = remaining > 0 ? remaining + " kursi tersisa" : "Kuota telah terpenuhi";
      remainingEl.parentElement.style.transform = "scale(1.05)";
      window.setTimeout(function () {
        remainingEl.parentElement.style.transform = "scale(1)";
      }, 220);
    }
    if (progressFillEl) progressFillEl.style.width = percent + "%";

    if (remaining <= 0) {
      const registerBtn = document.getElementById("registerBtn");
      if (registerBtn) {
        registerBtn.disabled = true;
        registerBtn.textContent = "Kuota Penuh";
      }
    }
  }

  /* ---------- Pendaftaran event via AJAX ---------- */

  const registerBtn = document.getElementById("registerBtn");

  if (registerBtn && config.registerUrl) {
    registerBtn.addEventListener("click", function () {
      if (registerBtn.disabled) return;

      const originalLabel = registerBtn.textContent;
      registerBtn.disabled = true;
      registerBtn.textContent = "Memproses…";

      fetch(config.registerUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-CSRF-TOKEN": config.csrfToken || "",
          "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify({})
      })
        .then(function (response) {
          return response.json().then(function (data) {
            return { ok: response.ok, status: response.status, data: data };
          });
        })
        .then(function (result) {
          if (result.status === 401) {
            showToast("Kamu harus login terlebih dahulu untuk mendaftar.", true);
            if (config.loginUrl) {
              window.setTimeout(function () {
                window.location.href = config.loginUrl;
              }, 1200);
            }
            registerBtn.disabled = false;
            registerBtn.textContent = originalLabel;
            return;
          }

          if (result.ok && result.data && result.data.success) {
            showToast(result.data.message || "Pendaftaran event berhasil dikonfirmasi!");
            registerBtn.textContent = "Terdaftar ✓";
            if (typeof result.data.registered_count !== "undefined" && config.quota) {
              updateQuotaDisplay(result.data.registered_count, config.quota);
            }
          if (result.data.whatsapp_url) {
            window.setTimeout(function () {
              window.open(result.data.whatsapp_url, '_blank');
            }, 800); 
          }

          } else {
            showToast((result.data && result.data.message) || "Terjadi kesalahan saat mendaftar.", true);
            registerBtn.disabled = false;
            registerBtn.textContent = originalLabel;
          }
        })
        .catch(function () {
          showToast("Gagal menghubungi server, coba lagi.", true);
          registerBtn.disabled = false;
          registerBtn.textContent = originalLabel;
        });
    });
  }

  /* ---------- Lightbox galeri dokumentasi (untuk event yang sudah selesai) ---------- */

  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightboxImage");
  const lightboxClose = document.getElementById("lightboxClose");

  function openLightbox(src, alt) {
    if (!lightbox || !lightboxImg) return;
    lightboxImg.src = src;
    lightboxImg.alt = alt || "Dokumentasi kegiatan";
    lightbox.classList.add("is-visible");
  }

  function closeLightbox() {
    if (!lightbox) return;
    lightbox.classList.remove("is-visible");
  }

  document.querySelectorAll(".gallery-grid .gallery-item img").forEach(function (img) {
    img.addEventListener("click", function () {
      openLightbox(img.getAttribute("src"), img.getAttribute("alt"));
    });
  });

  if (lightboxClose) lightboxClose.addEventListener("click", closeLightbox);
  if (lightbox) {
    lightbox.addEventListener("click", function (event) {
      if (event.target === lightbox) closeLightbox();
    });
  }

  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") closeLightbox();
  });

  lucide.createIcons();
})();