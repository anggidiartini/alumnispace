<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>memori. — {{ $album->title }}</title>

    <link rel="stylesheet" href="{{ asset('css/album.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body>

<x-navbar />

<div class="section-yellow">
  <div class="wrap">

    <a href="{{ route('album.index') }}" class="back-link">&larr; Kembali ke Album</a>

    <div class="detail-card">
      <div class="detail-photo">
        <span class="cat-pill {{ $album->category === 'outdoor' ? 'outdoor' : '' }}">
          {{ ucfirst($album->category) }}
        </span>
        <img src="{{ asset($album->cover_photo) }}" alt="{{ $album->title }}">
      </div>

      <div class="detail-body">
        <div class="label">{{ $album->subtitle_label ?? $album->target_generation }}</div>
        <h1>{{ $album->title }}</h1>
        <div class="date">{{ $album->date_display }} — {{ $album->location }}</div>
        <p class="detail-desc">{{ $album->description }}</p>
      </div>
    </div>

  </div>
</div>

<x-footer />

</body>
</html>