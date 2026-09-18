@extends('admin.layout.index')

@section('page_title', 'Detail Periode Kepengurusan')

@section('content')
<style>
	.period-detail-layout {
		display: grid;
		grid-template-columns: minmax(0, 1fr) 320px;
		gap: 24px;
		align-items: start;
	}
	.period-detail-panel {
		background: #fff;
		border: 1px solid #d0e1f0;
		border-radius: 16px;
		padding: 24px;
		box-shadow: 0 4px 15px rgba(10, 65, 116, .04);
	}
	.period-detail-heading {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 14px;
		padding-bottom: 16px;
		margin-bottom: 20px;
		border-bottom: 1px solid #d0e1f0;
	}
	.period-detail-heading h2 { margin: 0 0 4px; color: #0a4174; font-size: 20px; font-weight: 800; }
	.period-detail-heading p { margin: 0; color: #527597; font-size: 12px; }
	.period-info-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
	.period-info-box {
		min-height: 86px;
		padding: 16px;
		border: 1px solid #d0e1f0;
		border-radius: 10px;
		background: #f8fbfe;
	}
	.period-info-box.full { grid-column: 1 / -1; }
	.period-info-label { display: block; margin-bottom: 8px; color: #527597; font-size: 11px; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; }
	.period-info-value { color: #0a4174; font-size: 15px; font-weight: 700; line-height: 1.5; }
	.period-status { display: inline-flex; align-items: center; gap: 6px; padding: 6px 10px; border-radius: 999px; font-size: 12px; font-weight: 700; }
	.period-status-active { background: #d1fae5; border: 1px solid #a7f3d0; color: #047857; }
	.period-status-inactive { background: #f1f5f9; border: 1px solid #cbd5e1; color: #64748b; }
	.period-action-title { margin: 0 0 6px; color: #0a4174; font-size: 15px; font-weight: 800; }
	.period-action-text { margin: 0 0 18px; color: #527597; font-size: 12px; line-height: 1.6; }
	.period-action-button { display: flex; align-items: center; justify-content: center; gap: 7px; width: 100%; margin-top: 10px; padding: 11px 14px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 700; }
	.period-action-primary { background: #0a4174; color: #fff; }
	.period-action-secondary { border: 1px solid #d0e1f0; background: #fff; color: #527597; }
	.period-action-primary:hover, .period-action-secondary:hover { opacity: .88; }
	@media (max-width: 850px) {
		.period-detail-layout { grid-template-columns: 1fr; }
		.period-info-grid { grid-template-columns: 1fr; }
		.period-info-box.full { grid-column: auto; }
		.period-detail-heading { align-items: flex-start; flex-direction: column; }
	}
</style>

@php
	$today = now()->toDateString();
	$isActive = $period->start_date <= $today && (!$period->finish_date || $period->finish_date >= $today);
@endphp

<div class="period-detail-layout">
	<section class="period-detail-panel">
		<div class="period-detail-heading">
			<div>
				<h2>Detail Periode Kepengurusan</h2>
				<p>Informasi lengkap periode yang dipilih.</p>
			</div>
			<span class="period-status {{ $isActive ? 'period-status-active' : 'period-status-inactive' }}">
				<i class="fa-solid {{ $isActive ? 'fa-circle-check' : 'fa-circle-minus' }}"></i>
				{{ $isActive ? 'Aktif' : 'Tidak Aktif' }}
			</span>
		</div>

		<div class="period-info-grid">
			<div class="period-info-box full">
				<span class="period-info-label">Nama Periode</span>
				<div class="period-info-value">{{ $period->period_name }}</div>
			</div>
			<div class="period-info-box">
				<span class="period-info-label">Tanggal Mulai</span>
				<div class="period-info-value">{{ $period->start_date ? \Carbon\Carbon::parse($period->start_date)->locale('id')->translatedFormat('d F Y') : '-' }}</div>
			</div>
			<div class="period-info-box">
				<span class="period-info-label">Tanggal Selesai</span>
				<div class="period-info-value">{{ $period->finish_date ? \Carbon\Carbon::parse($period->finish_date)->locale('id')->translatedFormat('d F Y') : 'Masih Berjalan' }}</div>
			</div>
		</div>
	</section>

	<aside class="period-detail-panel">
		<h3 class="period-action-title">Aksi Pengelola</h3>
		<p class="period-action-text">Gunakan tombol berikut untuk mengelola data periode ini.</p>
		<a href="{{ route('admin.committee-periods.edit', $period->id) }}" class="period-action-button period-action-primary">
			<i class="fa-solid fa-pen-to-square"></i> Edit Periode
		</a>
		<a href="{{ route('admin.committee-periods.index') }}" class="period-action-button period-action-secondary">
			<i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
		</a>
		<a href="{{ route('admin.alumni-boards.index') }}" class="period-action-button period-action-secondary">
			<i class="fa-solid fa-users"></i> Ke Pengurus Alumni
		</a>
	</aside>
</div>
@endsection
