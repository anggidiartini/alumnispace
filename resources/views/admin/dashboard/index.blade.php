@extends('admin.layout.index')

@section('page_title', 'Dashboard Overview')

@section('content')
    <!-- WELCOME HERO BANNER -->
    <div class="hero-banner">
        <div class="hero-badge">Sistem Database Alumni Terintegrasi</div>
        <h2 class="hero-title">Selamat Datang di <span class="hero-title-highlight">Portal Database Alumni</span></h2>
        <p class="hero-desc">Kelola, pantau, dan eksplorasi data alumni, kepengurusan, prestasi, serta konten informasi
            institusi secara terpadu.</p>
    </div>

    <!-- BOX GRAFIK STATISTIK -->
    <div class="chart-card">
        <h3 class="chart-title">Statistik Pengunjung Hari Ini</h3>
        <div class="chart-container" x-data="{
            dataPengunjung: {{ json_encode($data ?? []) }},
            jam: {{ json_encode($labels ?? []) }},
            maxData: {{ isset($data) && count($data) > 0 ? max($data) : 100 }}
        }">
            <template x-for="(nilai, index) in dataPengunjung">
                <div class="chart-bar-group">
                    <div class="chart-tooltip" x-text="nilai + ' org'"></div>
                    <div class="chart-bar" :style="`height: ${(nilai / maxData) * 100}%`"></div>
                    <span class="chart-label" x-text="jam[index]"></span>
                </div>
            </template>
        </div>
    </div>
@endsection
