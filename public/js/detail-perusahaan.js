document.addEventListener('DOMContentLoaded', function () {
  if (window.lucide) lucide.createIcons();

  /* ---------- toast helper ---------- */
  var toast = document.getElementById('dpToast');
  var toastTimer;
  function showToast(message) {
    if (!toast) return;
    toast.textContent = message;
    toast.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function () {
      toast.classList.remove('show');
    }, 2600);
  }

  /* ---------- scroll ke section lowongan ---------- */
  var jobsButton = document.getElementById('jobsButton');
  var jobsSection = document.getElementById('lowongan');
  if (jobsButton && jobsSection) {
    jobsButton.addEventListener('click', function () {
      jobsSection.scrollIntoView({ behavior: 'smooth' });
    });
  }

  /* ---------- bookmark perusahaan ---------- */
  var bookmarkButton = document.getElementById('bookmarkButton');
  if (bookmarkButton) {
    bookmarkButton.addEventListener('click', function () {
      var saved = bookmarkButton.classList.toggle('is-saved');
      bookmarkButton.setAttribute('aria-pressed', String(saved));
      bookmarkButton.setAttribute('aria-label', saved ? 'Batalkan simpan perusahaan' : 'Simpan perusahaan');
      showToast(saved ? 'Perusahaan berhasil disimpan!' : 'Perusahaan dihapus dari simpanan.');
      // TODO: hubungkan ke endpoint bookmark backend di sini kalau sudah tersedia
    });
  }

  /* ---------- share perusahaan ---------- */
  var shareButton = document.getElementById('shareButton');
  if (shareButton) {
    shareButton.addEventListener('click', async function () {
      var shareData = {
        title: shareButton.dataset.title || document.title,
        text: 'Lihat profil perusahaan di Alumni Space',
        url: window.location.href
      };
      try {
        if (navigator.share) {
          await navigator.share(shareData);
        } else {
          await navigator.clipboard.writeText(window.location.href);
          showToast('Tautan perusahaan sudah disalin.');
        }
      } catch (error) {
        if (error.name !== 'AbortError') showToast('Tautan siap dibagikan.');
      }
    });
  }

  /* ---------- floating: tombol "on top" muncul saat scroll ---------- */
  var backToTop = document.getElementById('backToTop');
  if (backToTop) {
    var toggleBackToTop = function () {
      if (window.scrollY > 320) {
        backToTop.classList.add('is-visible');
      } else {
        backToTop.classList.remove('is-visible');
      }
    };
    toggleBackToTop();
    window.addEventListener('scroll', toggleBackToTop, { passive: true });
    backToTop.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ---------- reveal animation on scroll ---------- */
  var revealItems = document.querySelectorAll('.dp-reveal');
  if ('IntersectionObserver' in window && revealItems.length) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });
    revealItems.forEach(function (item) { observer.observe(item); });
  } else {
    revealItems.forEach(function (item) { item.classList.add('visible'); });
  }
});