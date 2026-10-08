@props([
    'data' => array_fill(0, 24, 0),
    'labels' => array_map(fn($h) => sprintf('%02d:00', $h), range(0, 23)),
    'maxData' => 10,
    'endpoint' => '/api/stats/hourly-today'
])

<div class="chart-card" x-data="visitorHourlyChartComponent({
    initialData: @js($data),
    initialLabels: @js($labels),
    initialMax: {{ $maxData ?? 10 }},
    statsEndpoint: '{{ $endpoint }}'
})">
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
            <p class="chart-subtitle">Statistik pengunjung unik per jam (00:00 - 23:00)</p>
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
        <!-- Grid Reference Lines -->
        <div class="chart-grid-lines">
            <div class="chart-grid-line"><span x-text="maxData + ' org'"></span></div>
            <div class="chart-grid-line"><span x-text="Math.round(maxData / 2) + ' org'"></span></div>
            <div class="chart-grid-line"><span>0</span></div>
        </div>

        <!-- Bar Chart Flexbox Container -->
        <div class="chart-container" aria-label="Grafik Bar Pengunjung 24 Jam">
            <template x-for="(nilai, index) in dataPengunjung" :key="index">
                <div class="chart-bar-group"
                     :class="{ 'touch-active': activeTouchIndex === index }"
                     @touchstart="activeTouchIndex = (activeTouchIndex === index ? null : index)"
                     tabindex="0"
                     :aria-label="jam[index] + ': ' + nilai + ' pengunjung'">
                    
                    <!-- Tooltip -->
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

                    <!-- Label Jam dengan Windowing Mobile -->
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

<script>
    if (typeof visitorHourlyChartComponent !== 'function') {
        function visitorHourlyChartComponent(config) {
            return {
                dataPengunjung: config.initialData || Array(24).fill(0),
                jam: config.initialLabels || Array.from({length: 24}, (_, i) => String(i).padStart(2, '0') + ':00'),
                maxData: config.initialMax || 10,
                endpoint: config.statsEndpoint || '/api/stats/hourly-today',
                totalPengunjung: 0,
                isLive: true,
                pollTimer: null,
                activeTouchIndex: null,
                lastUpdated: 'Baru saja',

                init() {
                    this.calculateTotal();
                    this.startPolling();

                    // Visibility pause: menghentikan polling saat tab di background
                    document.addEventListener('visibilitychange', () => {
                        if (document.hidden) {
                            this.stopPolling();
                            this.isLive = false;
                        } else {
                            this.isLive = true;
                            this.fetchStats();
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
                    }, 5000);
                },

                stopPolling() {
                    if (this.pollTimer) {
                        clearInterval(this.pollTimer);
                        this.pollTimer = null;
                    }
                },

                async fetchStats() {
                    try {
                        const response = await fetch(this.endpoint, {
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
                        console.warn('Polling statistik pengunjung gagal:', error);
                    }
                }
            };
        }
    }
</script>
