@extends('admin.layout.index')

@section('page_title', 'Manajemen Konten CMS')

@section('content')
<style>
    /* Vanilla CSS for CMS Admin Page */
    .cms-container {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 30px;
        align-items: start;
    }
    
    .cms-header {
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .cms-header h2 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 5px;
    }
    .cms-header p {
        font-size: 14px;
        color: var(--text-muted);
    }
    .badge-count {
        padding: 6px 12px;
        background-color: var(--badge-bg);
        color: var(--badge-text);
        font-size: 12px;
        font-weight: 700;
        border-radius: 20px;
    }

    .cms-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        transition: box-shadow 0.3s;
    }
    .cms-card:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        border-bottom: 1px solid #f0f4f8;
        padding-bottom: 16px;
        margin-bottom: 20px;
    }
    .card-key {
        padding: 4px 10px;
        background-color: #fff0a9;
        color: var(--text-main);
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .card-slug {
        margin-left: 8px;
        font-size: 12px;
        font-weight: 700;
        color: #9ca3af;
    }
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 700;
    }
    .status-badge.active { color: #059669; }
    .status-badge.inactive { color: #9ca3af; }
    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }
    .status-dot.active { background-color: #10b981; }
    .status-dot.inactive { background-color: #9ca3af; }

    .form-group {
        margin-bottom: 16px;
    }
    .form-group label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: var(--text-main);
        text-transform: uppercase;
        margin-bottom: 6px;
    }
    .form-control {
        width: 100%;
        padding: 10px 16px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        font-size: 14px;
        font-family: inherit;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control:focus {
        border-color: var(--color-secondary);
        box-shadow: 0 0 0 3px rgba(123, 189, 232, 0.2);
    }
    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    .card-footer {
        margin-top: 24px;
        padding-top: 16px;
        border-top: 1px solid #f0f4f8;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .last-updated {
        font-size: 12px;
        color: #9ca3af;
    }
    .btn-primary {
        padding: 10px 20px;
        background-color: var(--color-primary);
        color: #fff;
        font-weight: 700;
        font-size: 12px;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background-color 0.2s, transform 0.2s;
    }
    .btn-primary:hover {
        background-color: var(--bg-sidebar-hover);
        transform: translateY(-2px);
    }

    .sidebar-section {
        position: sticky;
        top: 24px;
    }
    .settings-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
    }
    .settings-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }
    .settings-icon {
        padding: 8px;
        background-color: #ffd9e7;
        color: var(--text-main);
        border-radius: 12px;
    }
    .settings-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-main);
    }
    .settings-desc {
        font-size: 12px;
        color: var(--text-muted);
        margin-bottom: 24px;
    }
    .setting-hint {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 4px;
    }
    .btn-submit-all {
        margin-top: 24px;
        width: 100%;
        padding: 12px;
        background-color: var(--color-primary);
        color: #fff;
        font-weight: 700;
        font-size: 12px;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        transition: opacity 0.2s;
    }
    .btn-submit-all:hover {
        opacity: 0.9;
    }

    .info-box {
        background-color: #f0f7ff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 20px;
        font-size: 12px;
        color: var(--text-main);
        line-height: 1.6;
    }
    .info-title {
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
    }
    .info-title i {
        color: var(--color-secondary);
    }
    .info-text {
        color: var(--text-muted);
    }
    .info-text code {
        background: #e1effe;
        padding: 2px 6px;
        border-radius: 4px;
        font-family: monospace;
    }

    .alert-success {
        margin-bottom: 24px;
        padding: 16px;
        background-color: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        font-weight: 600;
    }
    .alert-icon {
        color: #059669;
    }

    @media (max-width: 992px) {
        .cms-container {
            grid-template-columns: 1fr;
        }
        .sidebar-section {
            position: static;
        }
    }
</style>

<!-- Feedback Alert -->
@if(session('status'))
  <div class="alert-success">
    <i class="fa-solid fa-circle-check alert-icon"></i>
    <span>{{ session('status') }}</span>
  </div>
@endif

<div class="cms-container">
  
  <!-- SECTIONS LIST (CMS) -->
  <div class="cms-main">
    <div class="cms-header">
      <div>
        <h2>Konten Teks Halaman (CMS)</h2>
        <p>Ubah judul, subjudul, dan teks promosi yang tampil di halaman beranda / publik.</p>
      </div>
      <span class="badge-count">{{ count($contents) }} Seksi Aktif</span>
    </div>

    <div class="cms-list">
      @foreach($contents as $content)
      <div class="cms-card">
        <div class="card-header">
          <div>
            <span class="card-key">{{ $content->section_key }}</span>
            <span class="card-slug">Halaman: /{{ $content->page_slug }}</span>
          </div>
          <span class="status-badge {{ $content->is_active ? 'active' : 'inactive' }}">
            <span class="status-dot {{ $content->is_active ? 'active' : 'inactive' }}"></span>
            {{ $content->is_active ? 'Aktif di Web' : 'Nonaktif' }}
          </span>
        </div>

        <form action="{{ route('admin.content.update', $content->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="form-groups">
            <div class="form-group">
              <label>Judul Utama (Title)</label>
              <input type="text" name="title" value="{{ old('title', $content->title) }}" required class="form-control">
            </div>

            <div class="form-group">
              <label>Subjudul / Keterangan (Subtitle)</label>
              <textarea name="subtitle" class="form-control">{{ old('subtitle', $content->subtitle) }}</textarea>
            </div>

            @if($content->body_content)
            <div class="form-group">
              <label>Teks Paragraf Tambahan</label>
              <textarea name="body_content" class="form-control">{{ old('body_content', $content->body_content) }}</textarea>
            </div>
            @endif
          </div>

          <div class="card-footer">
            <span class="last-updated">Terakhir diubah: {{ $content->updated_at?->diffForHumans() ?? 'Baru saja' }}</span>
            <button type="submit" class="btn-primary">
              <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
      @endforeach
    </div>
  </div>

  <!-- GLOBAL SETTINGS SIDEBAR -->
  <div class="sidebar-section">
    <div class="settings-card">
      <div class="settings-header">
        <span class="settings-icon"><i class="fa-solid fa-gear"></i></span>
        <h3 class="settings-title">Pengaturan Umum</h3>
      </div>
      <p class="settings-desc">Konfigurasi teks administratif yang berlaku di seluruh halaman publik.</p>

      <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-groups">
          @foreach($settings as $setting)
          <div class="form-group">
            <label>{{ str_replace('_', ' ', $setting->key) }}</label>
            <input type="text" name="settings[{{ $setting->key }}]" value="{{ old("settings.{$setting->key}", $setting->value) }}" class="form-control" style="padding: 8px 12px;">
            @if($setting->description)
              <p class="setting-hint">{{ $setting->description }}</p>
            @endif
          </div>
          @endforeach
        </div>

        <button type="submit" class="btn-submit-all">
          <i class="fa-solid fa-check"></i> Simpan Semua Pengaturan
        </button>
      </form>
    </div>

    <!-- Quick Info Box -->
    <div class="info-box">
      <p class="info-title"><i class="fa-solid fa-shield-halved"></i> Role-Based Access Control Aktif</p>
      <p class="info-text">Halaman ini diproteksi oleh middleware <code>role:admin,super_admin</code>. Tamu dan user non-admin akan otomatis diblokir dengan status HTTP 403.</p>
    </div>
  </div>

</div>
@endsection
