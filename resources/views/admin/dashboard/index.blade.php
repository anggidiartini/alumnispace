@extends('admin.layout.index')

@section('page_title', 'Halaman Utama')

@section('content')
    <script defer src="https://jsdelivr.net"></script>
    <style>
        .hero-banner {
            background: linear-gradient(135deg, #062b4f 0%, #0a4174 50%, #125493 100%);
            border-radius: 12px;
            padding: 32px;
            color: #fff;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(10, 65, 116, 0.15);
        }
        .hero-banner::after {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(123, 189, 232, 0.1);
            border-radius: 50%;
        }
        .hero-badge {
            display: inline-block;
            background: rgba(123, 189, 232, 0.2);
            color: #7bbde8;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 16px;
        }
        .hero-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .hero-title-highlight {
            color: #7bbde8;
        }
        .hero-desc {
            font-size: 14px;
            color: #d0e1f0;
            max-width: 600px;
            line-height: 1.5;
        }

        .chart-card {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            border: 1px solid #d0e1f0;
        }
        .chart-title {
            font-size: 16px;
            font-weight: 600;
            color: #0a4174;
            margin-bottom: 24px;
        }
        .chart-container {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            height: 250px;
            padding-top: 20px;
            gap: 10px;
        }
        .chart-bar-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            flex: 1;
            height: 100%;
            position: relative;
        }
        .chart-bar {
            width: 100%;
            max-width: 40px;
            background: #7bbde8;
            border-radius: 6px 6px 0 0;
            transition: all 0.3s ease;
            min-height: 20px;
            cursor: pointer;
        }
        .chart-bar:hover {
            background: #0a4174;
        }
        .chart-label {
            margin-top: 10px;
            font-size: 12px;
            color: #527597;
            font-weight: 500;
        }
        .chart-tooltip {
            position: absolute;
            top: 20%;
            background: #062b4f;
            color: #fff;
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 4px;
            opacity: 0;
            transition: opacity 0.2s;
            pointer-events: none;
            white-space: nowrap;
            z-index: 10;
        }
        .chart-bar-group:hover .chart-tooltip {
            opacity: 1;
        }
    </style>

    <!-- WELCOME HERO BANNER -->
    <div class="hero-banner">
        <div class="hero-badge">Pusat Informasi Terintegrasi</div>
        <h2 class="hero-title">Selamat Datang di <span class="hero-title-highlight">Ruang Pengelola</span></h2>
        <p class="hero-desc">Pantau, perbarui, dan sesuaikan data alumni, agenda acara, berita terbaru, serta seluruh informasi operasional website dengan mudah di sini.</p>
    </div>

    <!-- BOX GRAFIK JALUR KUNJUNGAN -->
    <div class="chart-card">
        <h3 class="chart-title">Grafik Pengunjung Hari Ini</h3>
        <div class="chart-container" x-data="{
            dataPengunjung: {!! !empty($data) ? json_encode($data) : json_encode([]) !!},
            jam: {!! !empty($labels) ? json_encode($labels) : json_encode(['08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00']) !!},
            maxData: {!! !empty($data) ? max($data) : 100 !!}
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
