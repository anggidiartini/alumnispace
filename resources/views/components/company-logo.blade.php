@props([
    'logo' => null,
    'name' => 'Company',
    'size' => 40,
    'option' => 'initials', // 'initials' (Option A) or 'icon' (Option B)
    'class' => '',
])

@php
    $size = is_numeric($size) ? (int)$size : 40;
    $rawName = trim((string)($name ?? 'Company'));
    
    // Compute crisp 1–2 letter initials
    $words = preg_split('/\s+/', $rawName);
    if (count($words) >= 2 && !empty($words[0]) && !empty($words[1])) {
        $initials = strtoupper(mb_substr($words[0], 0, 1) . mb_substr($words[1], 0, 1));
    } else {
        $initials = strtoupper(mb_substr($rawName, 0, min(2, mb_strlen($rawName))));
    }
    if (empty($initials)) {
        $initials = 'CO';
    }

    // Determine font size and icon size proportional to container
    $fontSize = max(11, round($size * 0.35));
    $iconSize = max(16, round($size * 0.48));
    $radius = max(6, round($size * 0.2));

    $defaultLogoUrl = asset('assets/anggi/imagedefault.png');
    $isRemoteLogo = !empty($logo) && \Illuminate\Support\Str::startsWith($logo, ['http://', 'https://']);
    $isStoredLogo = !empty($logo) && !$isRemoteLogo && file_exists(public_path($logo));
    $logoUrl = ($isRemoteLogo || $isStoredLogo) ? ($isRemoteLogo ? $logo : asset($logo)) : $defaultLogoUrl;
@endphp

<div class="company-logo-wrapper {{ $class }}" 
     style="width: {{ $size }}px; height: {{ $size }}px; min-width: {{ $size }}px; min-height: {{ $size }}px; max-width: {{ $size }}px; max-height: {{ $size }}px; display: inline-flex; align-items: center; justify-content: center; position: relative; vertical-align: middle; flex-shrink: 0;">

    <img src="{{ $logoUrl }}"
         alt="Logo {{ $rawName }}"
         loading="lazy"
         class="company-logo-img"
         style="width: {{ $size }}px; height: {{ $size }}px; min-width: {{ $size }}px; min-height: {{ $size }}px; object-fit: cover; border-radius: {{ $radius }}px; border: 1px solid var(--border-color, #e2e8f0); display: block;"
         onerror="this.onerror=null; this.src='{{ $defaultLogoUrl }}';">
</div>
