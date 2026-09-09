<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CMS & Manajemen Konten Dinamis — Admin AlumniSpace</title>
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'DM Sans', sans-serif; }
    h1, h2, h3 { font-family: 'Fredoka', sans-serif; }
  </style>
</head>
<body class="bg-[#f8fbff] text-[#153563] min-h-screen">

  <!-- Top Admin Bar -->
  <header class="sticky top-0 z-40 bg-white border-b border-blue-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-5 py-3.5 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <span class="grid h-10 w-10 place-items-center rounded-xl bg-[#2e72ec] text-white font-bold text-lg">⚡</span>
        <div>
          <h1 class="text-xl font-bold text-[#153563]">AlumniSpace CMS</h1>
          <p class="text-xs text-[#355277]">Panel Manajemen Konten Dinamis & Pengaturan Situs</p>
        </div>
      </div>
      <div class="flex items-center gap-3">
        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-1.5 px-4 py-2 text-xs font-bold text-[#2e72ec] bg-blue-50 hover:bg-blue-100 rounded-xl transition">
          <i data-lucide="external-link" class="h-4 w-4"></i> Lihat Tampilan Live
        </a>
        <div class="h-6 w-px bg-gray-200"></div>
        <span class="text-xs font-bold px-3 py-1.5 bg-[#cce8de] text-[#153563] rounded-full">Admin: {{ Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-xl transition" title="Logout">
            <i data-lucide="log-out" class="h-4 w-4"></i>
          </button>
        </form>
      </div>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-5 py-8">
    <!-- Feedback Alert -->
    @if(session('status'))
      <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 font-semibold text-sm">
        <i data-lucide="check-circle-2" class="h-5 w-5 text-emerald-600"></i>
        <span>{{ session('status') }}</span>
      </div>
    @endif

    <div class="grid lg:grid-cols-[1fr_360px] gap-8 items-start">
      
      <!-- SECTIONS LIST (CMS) -->
      <div>
        <div class="mb-6 flex items-center justify-between">
          <div>
            <h2 class="text-2xl font-bold text-[#153563]">Konten Teks Halaman (CMS)</h2>
            <p class="text-sm text-[#355277]">Ubah judul, subjudul, dan teks promosi yang tampil di halaman beranda / publik.</p>
          </div>
          <span class="px-3 py-1 bg-blue-100 text-[#2e72ec] text-xs font-bold rounded-full">{{ count($contents) }} Seksi Aktif</span>
        </div>

        <div class="space-y-6">
          @foreach($contents as $content)
          <div class="bg-white rounded-2xl border border-blue-100 p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between border-b border-gray-100 pb-4 mb-5">
              <div>
                <span class="px-2.5 py-1 bg-[#fff0a9] text-[#153563] rounded-lg text-xs font-bold uppercase tracking-wider">
                  {{ $content->section_key }}
                </span>
                <span class="ml-2 text-xs font-bold text-gray-400">Halaman: /{{ $content->page_slug }}</span>
              </div>
              <span class="inline-flex items-center gap-1 text-xs font-bold {{ $content->is_active ? 'text-emerald-600' : 'text-gray-400' }}">
                <span class="h-2 w-2 rounded-full {{ $content->is_active ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                {{ $content->is_active ? 'Aktif di Web' : 'Nonaktif' }}
              </span>
            </div>

            <form action="{{ route('admin.content.update', $content->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="space-y-4">
                <div>
                  <label class="block text-xs font-bold text-[#153563] uppercase mb-1">Judul Utama (Title)</label>
                  <input type="text" name="title" value="{{ old('title', $content->title) }}" required
                    class="w-full px-4 py-2.5 rounded-xl border border-blue-200 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-[#2e72ec]">
                </div>

                <div>
                  <label class="block text-xs font-bold text-[#153563] uppercase mb-1">Subjudul / Keterangan (Subtitle)</label>
                  <textarea name="subtitle" rows="2"
                    class="w-full px-4 py-2.5 rounded-xl border border-blue-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#2e72ec]">{{ old('subtitle', $content->subtitle) }}</textarea>
                </div>

                @if($content->body_content)
                <div>
                  <label class="block text-xs font-bold text-[#153563] uppercase mb-1">Teks Paragraf Tambahan</label>
                  <textarea name="body_content" rows="2"
                    class="w-full px-4 py-2.5 rounded-xl border border-blue-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#2e72ec]">{{ old('body_content', $content->body_content) }}</textarea>
                </div>
                @endif
              </div>

              <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs text-gray-400">Terakhir diubah: {{ $content->updated_at?->diffForHumans() ?? 'Baru saja' }}</span>
                <button type="submit" class="px-5 py-2.5 bg-[#2e72ec] text-white font-bold text-xs rounded-xl shadow hover:bg-blue-600 transition flex items-center gap-1.5">
                  <i data-lucide="save" class="h-4 w-4"></i> Simpan Perubahan
                </button>
              </div>
            </form>
          </div>
          @endforeach
        </div>
      </div>

      <!-- GLOBAL SETTINGS SIDEBAR -->
      <div class="sticky top-24 space-y-6">
        <div class="bg-white rounded-2xl border border-blue-100 p-6 shadow-sm">
          <div class="flex items-center gap-2 mb-4">
            <span class="p-2 bg-[#ffd9e7] text-[#153563] rounded-xl"><i data-lucide="settings" class="h-4 w-4"></i></span>
            <h3 class="text-lg font-bold text-[#153563]">Pengaturan Umum Situs</h3>
          </div>
          <p class="text-xs text-[#355277] mb-5">Konfigurasi teks administratif yang berlaku di seluruh halaman publik.</p>

          <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
              @foreach($settings as $setting)
              <div>
                <label class="block text-xs font-bold text-[#153563] uppercase mb-1">{{ str_replace('_', ' ', $setting->key) }}</label>
                <input type="text" name="settings[{{ $setting->key }}]" value="{{ old("settings.{$setting->key}", $setting->value) }}"
                  class="w-full px-3.5 py-2 rounded-xl border border-blue-200 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#2e72ec]">
                @if($setting->description)
                  <p class="text-[11px] text-gray-400 mt-1">{{ $setting->description }}</p>
                @endif
              </div>
              @endforeach
            </div>

            <button type="submit" class="mt-6 w-full py-3 bg-[#153563] text-white font-bold text-xs rounded-xl shadow hover:bg-opacity-90 transition flex items-center justify-center gap-1.5">
              <i data-lucide="check" class="h-4 w-4"></i> Simpan Semua Pengaturan
            </button>
          </form>
        </div>

        <!-- Quick Info Box -->
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 text-xs text-[#153563] leading-relaxed">
          <p class="font-bold flex items-center gap-1.5 mb-1.5"><i data-lucide="shield-check" class="h-4 w-4 text-[#2e72ec]"></i> Role-Based Access Control Aktif</p>
          <p class="text-[#355277]">Halaman ini diproteksi oleh middleware <code>role:admin,super_admin</code>. Tamu dan user non-admin akan otomatis diblokir dengan status HTTP 403.</p>
        </div>
      </div>

    </div>
  </main>

  <script>
    lucide.createIcons();
  </script>
</body>
</html>
