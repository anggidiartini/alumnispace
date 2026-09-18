/* =========================================================
   event-register.js — logic modal pendaftaran event.
   Dipicu oleh #registerBtn (tombol "Daftar Sekarang") yang
   sudah ada di detail-event.blade.php. Submit form via fetch
   ke window.EventDetailConfig.registerUrl (route event.register
   yang sudah disiapkan backend). Setelah sukses, tampilkan pesan
   bahwa email konfirmasi (berisi link WA ke panitia) sudah
   dikirim — pengiriman email itu sendiri sepenuhnya tugas
   backend, di sini hanya menampilkan hasilnya.
   ========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    var config = window.EventDetailConfig || {};
    var overlay = document.getElementById("erOverlay");
    var registerBtn = document.getElementById("registerBtn");

    if (!overlay || !registerBtn) return;

    var closeBtn = document.getElementById("erClose");
    var stepForm = document.getElementById("erStepForm");
    var stepSuccess = document.getElementById("erStepSuccess");
    var form = document.getElementById("erForm");
    var submitBtn = document.getElementById("erSubmitBtn");
    var formError = document.getElementById("erFormError");
    var successMessage = document.getElementById("erSuccessMessage");
    var doneBtn = document.getElementById("erDoneBtn");

    function clearFieldErrors() {
        form.querySelectorAll(".er-error").forEach(function (el) { el.textContent = ""; });
        form.querySelectorAll(".er-field").forEach(function (el) { el.classList.remove("has-error"); });
        formError.hidden = true;
        formError.textContent = "";
    }

    function openModal() {
        overlay.classList.add("is-open");
        overlay.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
        stepForm.hidden = false;
        stepSuccess.hidden = true;
        clearFieldErrors();
        form.reset();
        setTimeout(function () {
            var firstInput = form.querySelector("input");
            if (firstInput) firstInput.focus();
        }, 50);
    }

    function closeModal() {
        overlay.classList.remove("is-open");
        overlay.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
    }

    registerBtn.addEventListener("click", openModal);
    if (closeBtn) closeBtn.addEventListener("click", closeModal);
    if (doneBtn) doneBtn.addEventListener("click", closeModal);

    overlay.addEventListener("click", function (e) {
        if (e.target === overlay) closeModal();
    });

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && overlay.classList.contains("is-open")) closeModal();
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        clearFieldErrors();

        if (!config.registerUrl) {
            formError.hidden = false;
            formError.textContent = "URL pendaftaran belum tersedia. Hubungi admin.";
            return;
        }

        var payload = {
            name: form.name.value.trim(),
            email: form.email.value.trim(),
            phone: form.phone.value.trim(),
            quantity: form.quantity ? parseInt(form.quantity.value) || 1 : 1
        };

        submitBtn.disabled = true;
        submitBtn.classList.add("is-loading");

        fetch(config.registerUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": config.csrfToken || ""
            },
            body: JSON.stringify(payload)
        })
            .then(function (response) {
                return response.json().catch(function () { return {}; }).then(function (data) {
                    return { ok: response.ok, status: response.status, data: data };
                });
            })
            .then(function (result) {
                submitBtn.disabled = false;
                submitBtn.classList.remove("is-loading");

                if (result.ok) {
                    stepForm.hidden = true;
                    stepSuccess.hidden = false;
                    successMessage.textContent = (result.data && result.data.message)
                        ? result.data.message
                        : "Pendaftaran berhasil! Mengalihkan ke WhatsApp panitia untuk konfirmasi...";

                    // Update live quota on page
                    if (result.data && typeof result.data.registered_count !== 'undefined') {
                        var newUsed = result.data.used_quota || result.data.registered_count;
                        var totalQ = result.data.total_quota || config.quota;
                        var remaining = typeof result.data.remaining_quota !== 'undefined' ? result.data.remaining_quota : Math.max(0, totalQ - newUsed);
                        
                        var quotaCountEl = document.querySelector("[data-role='quota-count']");
                        var remainingEl = document.querySelector("[data-role='remaining-count']");
                        var infoQuotaEl = document.querySelector("[data-role='info-quota']");
                        var progressFillEl = document.querySelector(".progress-fill");

                        if (quotaCountEl) quotaCountEl.textContent = newUsed + " / " + totalQ;
                        if (infoQuotaEl) infoQuotaEl.innerHTML = '<span>' + newUsed + '</span> dari ' + totalQ + ' peserta <small style="display: block; font-size: 11px; color: ' + (remaining > 0 ? '#166534' : '#991b1b') + '; font-weight: 700;">(Sisa ' + remaining + ' kursi)</small>';
                        if (remainingEl) remainingEl.textContent = remaining > 0 ? remaining + " kursi tersisa" : "Kuota telah terpenuhi";
                        if (progressFillEl && totalQ > 0) progressFillEl.style.width = Math.min(100, Math.round((newUsed / totalQ) * 100)) + "%";

                        if (remaining <= 0) {
                            if (registerBtn) {
                                registerBtn.disabled = true;
                                registerBtn.textContent = "Kuota Penuh";
                            }
                            var sidebarBtn = document.getElementById("registerBtnSidebar");
                            if (sidebarBtn) {
                                sidebarBtn.disabled = true;
                                sidebarBtn.textContent = "Kuota Penuh";
                            }
                        }
                    }

                    // Add direct WhatsApp button if present
                    if (result.data && result.data.whatsapp_url) {
                        var existingWa = document.getElementById("erWaBtn");
                        if (!existingWa && doneBtn && doneBtn.parentElement) {
                            var waBtn = document.createElement("a");
                            waBtn.id = "erWaBtn";
                            waBtn.className = "primary-button";
                            waBtn.style.cssText = "display: block; margin-top: 12px; margin-bottom: 8px; text-align: center; text-decoration: none; background: #25D366; color: white;";
                            waBtn.target = "_blank";
                            waBtn.rel = "noopener";
                            waBtn.textContent = "💬 Hubungi WA Panitia Sekarang";
                            waBtn.href = result.data.whatsapp_url;
                            doneBtn.parentElement.insertBefore(waBtn, doneBtn);
                        }
                    }

                    if (window.lucide) window.lucide.createIcons();
                    return;
                }

                // Validasi gagal (422) — tampilkan pesan per field dari Laravel.
                if (result.status === 422 && result.data && result.data.errors) {
                    Object.keys(result.data.errors).forEach(function (field) {
                        var target = form.querySelector('[data-error-for="' + field + '"]');
                        if (target) {
                            target.textContent = result.data.errors[field][0];
                            var wrap = target.closest(".er-field");
                            if (wrap) wrap.classList.add("has-error");
                        }
                    });
                    return;
                }

                // Belum login & ada route login — arahkan ke sana.
                if (result.status === 401 && config.loginUrl) {
                    window.location.href = config.loginUrl;
                    return;
                }

                formError.hidden = false;
                formError.textContent = (result.data && result.data.message)
                    ? result.data.message
                    : "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
            })
            .catch(function () {
                submitBtn.disabled = false;
                submitBtn.classList.remove("is-loading");
                formError.hidden = false;
                formError.textContent = "Gagal menghubungi server. Periksa koneksi internet kamu.";
            });
    });

    if (window.lucide) window.lucide.createIcons();
});