@extends('admin.layout.index')

@section('page_title', 'Halaman Utama')

@section('content')
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        /* Hero Banner */
        .hero-banner {
            background: linear-gradient(135deg, #062b4f 0%, #0a4174 50%, #125493 100%);
            border-radius: 12px;
            padding: 32px;
            color: #fff;
            margin-bottom: 24px;
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
            pointer-events: none;
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

        /* Chart Card */
        .chart-card {
            background: #fff;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(10, 65, 116, 0.06);
            border: 1px solid #d0e1f0;
            position: relative;
        }

        /* Chart Header */
        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f0f4f8;
        }
        .chart-header-left {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .chart-title {
            font-size: 17px;
            font-weight: 700;
            color: #0a4174;
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }
        .chart-subtitle {
            font-size: 12px;
            color: #527597;
            margin: 0;
        }
        .chart-header-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* Live Indicator Badge */
        .live-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #e8f7ee;
            color: #1b874b;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 700;
            border: 1px solid #c4eed3;
            transition: all 0.3s ease;
        }
        .live-badge.is-paused {
            background: #f1f5f9;
            color: #64748b;
            border-color: #cbd5e1;
        }
        .live-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
            animation: pulse-dot 1.8s infinite;
        }
        .live-badge.is-paused .live-dot {
            background: #94a3b8;
            animation: none;
        }
        @keyframes pulse-dot {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 6px rgba(34, 197, 94, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
            }
        }

        /* Stats Total Summary Pill */
        .chart-stat-pill {
            background: #f0f7fc;
            color: #0a4174;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid #d0e1f0;
        }
        .chart-stat-number {
            color: #125493;
            font-size: 13px;
        }

        /* Chart Canvas Area */
        .chart-canvas {
            position: relative;
            background: linear-gradient(180deg, #fafcff 0%, #ffffff 100%);
            border-radius: 10px;
            border: 1px solid #eef4f9;
            padding: 24px 14px 12px 14px;
        }

        /* Grid lines */
        .chart-grid-lines {
            position: absolute;
            inset: 24px 14px 44px 14px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            pointer-events: none;
            z-index: 1;
        }
        .chart-grid-line {
            width: 100%;
            height: 1px;
            background: #edf3f8;
            position: relative;
        }
        .chart-grid-line span {
            position: absolute;
            right: 4px;
            top: -9px;
            font-size: 10px;
            color: #94aabf;
            font-weight: 600;
        }

        /* Container Flexbox */
        .chart-container {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            height: 220px;
            gap: 6px;
            position: relative;
            z-index: 2;
        }

        /* Individual Bar Group */
        .chart-bar-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            flex: 1;
            height: 100%;
            position: relative;
            min-width: 0;
            cursor: pointer;
        }

        /* Bar Track / Standup Baseline */
        .chart-bar-track {
            width: 100%;
            max-width: 32px;
            height: 100%;
            display: flex;
            align-items: flex-end;
            position: relative;
        }

        /* Bar Column */
        .chart-bar {
            width: 100%;
            border-radius: 6px 6px 2px 2px;
            background: #9acdeb;
            transition: height 0.4s ease-in-out, background-color 0.25s ease, transform 0.2s ease, box-shadow 0.25s ease;
            position: relative;
            min-height: 5px; /* Tetap berdiri tegak meski nilai 0 */
        }
        .chart-bar.has-data {
            background: linear-gradient(180deg, #185a9d 0%, #0a4174 100%);
            box-shadow: 0 2px 4px rgba(10, 65, 116, 0.15);
        }
        .chart-bar.is-zero {
            background: #d4e7f5;
            opacity: 0.75;
        }
        .chart-bar-group:hover .chart-bar {
            background: linear-gradient(180deg, #f2b600 0%, #d89600 100%) !important;
            transform: scaleX(1.08);
            box-shadow: 0 4px 10px rgba(216, 150, 0, 0.35);
        }

        /* Tooltip */
        .chart-tooltip {
            position: absolute;
            bottom: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%) translateY(4px);
            background: #062b4f;
            color: #fff;
            font-size: 11px;
            padding: 6px 9px;
            border-radius: 6px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s;
            pointer-events: none;
            white-space: nowrap;
            z-index: 20;
            box-shadow: 0 4px 14px rgba(6, 43, 79, 0.35);
            text-align: center;
        }
        .chart-tooltip::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border-width: 5px;
            border-style: solid;
            border-color: #062b4f transparent transparent transparent;
        }
        .chart-tooltip-time {
            font-size: 10px;
            color: #a0cbed;
            margin-bottom: 2px;
            font-weight: 500;
        }
        .chart-tooltip-val {
            font-size: 12px;
            font-weight: 700;
            color: #fff;
        }
        .chart-bar-group:hover .chart-tooltip,
        .chart-bar-group:focus .chart-tooltip,
        .chart-bar-group.touch-active .chart-tooltip {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }

        /* Hour Labels below the bar */
        .chart-label {
            margin-top: 10px;
            font-size: 11px;
            color: #527597;
            font-weight: 600;
            text-align: center;
            user-select: none;
            height: 16px;
            line-height: 16px;
        }
        .chart-bar-group:hover .chart-label {
            color: #0a4174;
            font-weight: 700;
        }

        /* Footer Info Bar */
        .chart-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 14px;
            padding-top: 10px;
            font-size: 11.5px;
            color: #7b9bb9;
            flex-wrap: wrap;
            gap: 8px;
        }
        .chart-legend {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .legend-color {
            width: 10px;
            height: 10px;
            border-radius: 2px;
        }
        .legend-color.color-active {
            background: #0a4174;
        }
        .legend-color.color-zero {
            background: #d4e7f5;
        }

        /* Windowing di Mobile / Responsiveness */
        @media (max-width: 992px) {
            .chart-container {
                gap: 4px;
            }
            .chart-label {
                font-size: 10px;
            }
        }
        @media (max-width: 768px) {
            .chart-container {
                gap: 2.5px;
                height: 200px;
            }
            .chart-bar-track {
                max-width: 100%;
            }
            /* Windowing label mobile: Hanya tampilkan kelipatan 4 jam (00, 04, 08, 12, 16, 20) agar tidak tumpang tindih */
            .chart-label {
                display: none;
                font-size: 9.5px;
            }
            .chart-label.chart-label-windowed {
                display: block;
            }
        }
        @media (max-width: 480px) {
            .chart-container {
                gap: 2px;
                height: 180px;
            }
            .chart-card {
                padding: 16px;
            }
            .chart-canvas {
                padding: 16px 8px 8px 8px;
            }
        }
    </style>

    <!-- WELCOME HERO BANNER -->
    <div class="hero-banner">
        <div class="hero-badge">Pusat Informasi Terintegrasi</div>
        <h2 class="hero-title">Selamat Datang di <span class="hero-title-highlight">Ruang Pengelola</span></h2>
        <p class="hero-desc">Pantau, perbarui, dan sesuaikan data alumni, agenda acara, berita terbaru, serta seluruh informasi operasional website dengan mudah di sini.</p>
    </div>

    <!-- BOX GRAFIK JALUR KUNJUNGAN 24 JAM LIVE -->
    <div class="chart-card" x-data="visitorHourlyChart()">
        <div class="chart-header">
            <div class="chart-header-left">
                <h3 class="chart-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="color:#0a4174;">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                    </svg>
                    Grafik Pengunjung Hari Ini (24 Jam)
                </h3>
                <p class="chart-subtitle">Statistik pengunjung per jam dari 00:00 s/d 23:00</p>
            </div>

            <div class="chart-header-right">
                <span class="chart-stat-pill">
                    Total Hari Ini: <strong class="chart-stat-number" x-text="totalPengunjung + ' org'"></strong>
                </span>
                <span class="live-badge" :class="{ 'is-paused': !isLive }" :title="isLive ? 'Live update aktif setiap 5 detik' : 'Dijeda saat tab tidak aktif untuk menghemat daya'">
                    <span class="live-dot"></span>
                    <span x-text="isLive ? 'Live (5s)' : 'Dijeda (Tab Pasif)'"></span>
                </span>
            </div>
        </div>

        <div class="chart-canvas">
            <!-- Subtle Grid Reference Lines -->
            <div class="chart-grid-lines">
                <div class="chart-grid-line">
                    <span x-text="maxData + ' org'"></span>
                </div>
                <div class="chart-grid-line">
                    <span x-text="Math.round(maxData / 2) + ' org'"></span>
                </div>
                <div class="chart-grid-line">
                    <span>0</span>
                </div>
            </div>

            <!-- Bar Chart Flexbox Container -->
            <div class="chart-container" aria-label="Grafik Bar Pengunjung 24 Jam">
                <template x-for="(nilai, index) in dataPengunjung" :key="index">
                    <div class="chart-bar-group"
                         :class="{ 'touch-active': activeTouchIndex === index }"
                         @touchstart="activeTouchIndex = (activeTouchIndex === index ? null : index)"
                         tabindex="0"
                         :aria-label="jam[index] + ': ' + nilai + ' pengunjung'">
                        <!-- Tooltip Nilai & Jam -->
                        <div class="chart-tooltip" role="tooltip">
                            <div class="chart-tooltip-time" x-text="jam[index] + ' - ' + jam[index].slice(0, 2) + ':59'"></div>
                            <div class="chart-tooltip-val" x-text="nilai + ' pengunjung'"></div>
                        </div>

                        <!-- Bar Track -->
                        <div class="chart-bar-track">
                            <div class="chart-bar"
                                 :class="{ 'has-data': nilai > 0, 'is-zero': nilai === 0 }"
                                 :style="`height: ${nilai === 0 ? '5px' : Math.max(5, (nilai / maxData) * 100) + '%'}`">
                            </div>
                        </div>

                        <!-- Hour Label dengan Windowing di Mobile (tiap kelipatan 4 jam) -->
                        <span class="chart-label"
                              :class="{ 'chart-label-windowed': index % 4 === 0 }"
                              x-text="jam[index]">
                        </span>
                    </div>
                </template>
            </div>
        </div>

        <!-- Footer Info & Legend -->
        <div class="chart-footer">
            <div class="chart-legend">
                <div class="legend-item">
                    <span class="legend-color color-active"></span>
                    <span>Ada Pengunjung</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color color-zero"></span>
                    <span>0 Pengunjung (Standby)</span>
                </div>
            </div>
            <div>
                <span>Terakhir diperbarui: </span>
                <strong style="color:#0a4174;" x-text="lastUpdated"></strong>
            </div>
        </div>
    </div>

    <!-- Alpine.js Component Script -->
    <script>
        function visitorHourlyChart() {
            return {
                dataPengunjung: {!! !empty($data) ? json_encode($data) : json_encode(array_fill(0, 24, 0)) !!},
                jam: {!! !empty($labels) ? json_encode($labels) : json_encode(array_map(fn($h) => sprintf('%02d:00', $h), range(0, 23))) !!},
                maxData: {{ $maxData ?? 10 }},
                totalPengunjung: 0,
                isLive: true,
                pollTimer: null,
                activeTouchIndex: null,
                lastUpdated: 'Baru saja',

                init() {
                    this.calculateTotal();
                    this.startPolling();

                    // Solusi Performa: Hentikan polling saat tab tidak aktif (background / minimize)
                    document.addEventListener('visibilitychange', () => {
                        if (document.hidden) {
                            this.stopPolling();
                            this.isLive = false;
                        } else {
                            this.isLive = true;
                            this.fetchStats(); // Update instan saat tab dibuka kembali
                            this.startPolling();
                        }
                    });
                },

                calculateTotal() {
                    if (Array.isArray(this.dataPengunjung)) {
                        this.totalPengunjung = this.dataPengunjung.reduce((acc, curr) => acc + Number(curr || 0), 0);
                    }
                },

                startPolling() {
                    if (this.pollTimer) clearInterval(this.pollTimer);
                    this.pollTimer = setInterval(() => {
                        this.fetchStats();
                    }, 5000); // Polling setiap 5 detik
                },

                stopPolling() {
                    if (this.pollTimer) {
                        clearInterval(this.pollTimer);
                        this.pollTimer = null;
                    }
                },

                async fetchStats() {
                    try {
                        const response = await fetch('/api/stats/hourly-today', {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!response.ok) return;

                        const result = await response.json();

                        if (result && Array.isArray(result.data) && Array.isArray(result.labels)) {
                            this.dataPengunjung = result.data;
                            this.jam = result.labels;
                            // Minimal 10 agar skala persentase stabil dan tidak error
                            this.maxData = Math.max(10, Number(result.max) || 10);
                            this.calculateTotal();

                            const now = new Date();
                            this.lastUpdated = now.toLocaleTimeString('id-ID', {
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit'
                            });
                        }
                    } catch (error) {
                        console.warn('Gagal memperbarui grafik pengunjung live:', error);
                    }
                }
            };
        }
    </script>
@endsection
