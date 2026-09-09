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
            phone: form.phone.value.trim()
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
                        : "Kami sudah mengirim email konfirmasi berisi link WhatsApp untuk konfirmasi ke panitia. Silakan cek inbox (atau folder spam) kamu.";
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