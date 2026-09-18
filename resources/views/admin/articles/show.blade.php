@extends('admin.layout.index')

@section('page_title', 'Detail Artikel')

@section('content')
<article style="max-width:900px;background:#fff;border:1px solid var(--border-color);border-radius:12px;padding:24px;">
    <p style="color:var(--text-muted);font-size:13px;">{{ $article->category }} · {{ $article->is_published ? 'Diterbitkan' : 'Draf' }}</p>
    <h1 style="margin:10px 0 16px;color:var(--text-main);">{{ $article->title }}</h1>
    @if($article->thumbnail)
        <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}" style="max-width:100%;max-height:320px;object-fit:cover;border-radius:8px;margin-bottom:18px;">
    @endif
    @if($article->excerpt)<p style="font-weight:700;margin-bottom:18px;">{{ $article->excerpt }}</p>@endif
    <div style="line-height:1.7;">{!! $article->content !!}</div>
    <div style="margin-top:24px;"><a href="{{ route('admin.articles.edit', $article->id) }}">Edit artikel</a> · <a href="{{ route('admin.articles.index') }}">Kembali</a></div>
</article>
@endsection