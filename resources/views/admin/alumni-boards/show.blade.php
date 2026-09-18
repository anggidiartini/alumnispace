@extends('admin.layout.index')

@section('page_title', 'Detail Pengurus Alumni')

@section('content')
<article style="max-width:760px;background:#fff;border:1px solid var(--border-color);border-radius:12px;padding:24px;"><p style="color:var(--text-muted);font-size:13px;">Detail dari tabel alumni_committees</p><h1 style="margin:10px 0 20px;color:var(--text-main);">{{ $board->alumni_name }}</h1><p><strong>Jabatan:</strong> {{ $board->position }}</p><p><strong>Periode:</strong> {{ $board->period_name }}</p><p><strong>Mulai:</strong> {{ $board->start_date ? \Carbon\Carbon::parse($board->start_date)->format('d M Y') : '-' }}</p><p><strong>Selesai:</strong> {{ $board->finish_date ? \Carbon\Carbon::parse($board->finish_date)->format('d M Y') : 'Masih berjalan' }}</p><div style="margin-top:24px;"><a href="{{ route('admin.alumni-boards.edit', $board->id) }}">Edit</a> · <a href="{{ route('admin.alumni-boards.index') }}">Kembali</a></div></article>
@endsection