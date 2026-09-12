document.addEventListener('DOMContentLoaded', function () {
    /* ---------- toast ---------- */
    var toast = document.getElementById('toast');
    var toastTimer;
    function showToast(message) {
        if (!toast) return;
        toast.textContent = message;
        toast.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () { toast.classList.remove('show'); }, 2600);
    }

    /* ---------- reveal on scroll ---------- */
    var revealEls = document.querySelectorAll('.reveal-onscroll');
    if ('IntersectionObserver' in window && revealEls.length) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        revealEls.forEach(function (el) { io.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('in-view'); });
    }

    /* ---------- scroll ke lowongan ---------- */
    var viewJobsButton = document.getElementById('viewJobsButton');
    var jobsSection = document.getElementById('lowongan');
    if (viewJobsButton && jobsSection) {
        viewJobsButton.addEventListener('click', function () {
            jobsSection.scrollIntoView({ behavior: 'smooth' });
        });
    }

    /* ---------- bookmark ---------- */
    var bookmarkButton = document.getElementById('bookmarkButton');
    if (bookmarkButton) {
        bookmarkButton.addEventListener('click', function () {
            var saved = bookmarkButton.classList.toggle('is-saved');
            bookmarkButton.setAttribute('aria-pressed', String(saved));
            showToast(saved ? 'Perusahaan berhasil disimpan!' : 'Perusahaan dihapus dari simpanan.');
        });
    }

    /* ---------- toggle detail lowongan ---------- */
    document.querySelectorAll('.dc-job-detail-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var job = btn.closest('.dc-job');
            var expanded = job.classList.toggle('is-expanded');
            btn.setAttribute('aria-expanded', String(expanded));
            btn.textContent = expanded ? 'Sembunyikan' : 'Lihat Detail';
        });
    });

    /* ---------- back to top ---------- */
    var backToTop = document.getElementById('back-to-top');
    if (backToTop) {
        window.addEventListener('scroll', function () {
            backToTop.classList.toggle('show', window.scrollY > 320);
        });
        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* ---------- WA bubble ---------- */
    var waBubble = document.getElementById('wa-bubble');
    var waButton = document.getElementById('wa-button');
    var waWidget = document.getElementById('wa-widget');
    var waClose = document.getElementById('wa-bubble-close');
    var waHideTimer;

    function openWaBubble() {
        if (!waBubble) return;
        clearTimeout(waHideTimer);
        waBubble.classList.add('show');
    }
    function closeWaBubble() {
        if (!waBubble) return;
        waBubble.classList.remove('show');
    }

    if (waBubble) {
        setTimeout(function () {
            openWaBubble();
            waHideTimer = setTimeout(closeWaBubble, 4000);
        }, 1000);
    }

    if (waClose) {
        waClose.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            closeWaBubble();
        });
    }
    if (waWidget) {
        waWidget.addEventListener('mouseenter', openWaBubble);
        waWidget.addEventListener('mouseleave', function () {
            waHideTimer = setTimeout(closeWaBubble, 800);
        });
    }
});