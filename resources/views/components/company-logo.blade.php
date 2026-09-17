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

    $logoUrl = null;
    if (!empty($logo)) {
        $logoUrl = \Illuminate\Support\Str::startsWith($logo, ['http://', 'https://']) 
            ? $logo 
            : asset($logo);
    }
@endphp

<div class="company-logo-wrapper {{ $class }}" 
     style="width: {{ $size }}px; height: {{ $size }}px; min-width: {{ $size }}px; min-height: {{ $size }}px; max-width: {{ $size }}px; max-height: {{ $size }}px; display: inline-flex; align-items: center; justify-content: center; position: relative; vertical-align: middle; flex-shrink: 0;">

    @if(!empty($logoUrl))
        <img src="{{ $logoUrl }}" 
             alt="Logo {{ $rawName }}" 
             loading="lazy"
             class="company-logo-img"
             style="width: {{ $size }}px; height: {{ $size }}px; min-width: {{ $size }}px; min-height: {{ $size }}px; object-fit: cover; border-radius: {{ $radius }}px; border: 1px solid var(--border-color, #e2e8f0); display: block;"
             onerror="this.onerror=null; this.style.display='none'; if(this.nextElementSibling){ this.nextElementSibling.style.display='inline-flex'; }">
    @endif

    {{-- Fallback placeholder container: hidden if image is present (until onerror), or displayed immediately if logo is empty --}}
    <div class="company-logo-placeholder {{ $option === 'icon' ? 'placeholder-icon-mode' : 'placeholder-initials-mode' }}"
         style="{{ !empty($logoUrl) ? 'display: none;' : 'display: inline-flex;' }} width: {{ $size }}px; height: {{ $size }}px; min-width: {{ $size }}px; min-height: {{ $size }}px; border-radius: {{ $radius }}px; align-items: center; justify-content: center; flex-shrink: 0; box-sizing: border-box; user-select: none; text-align: center;
         @if($option === 'icon')
             background: var(--bg-main, #f8fafc); border: 1.5px solid var(--border-color, #e2e8f0); color: var(--color-primary, #0a4174);
         @else
             background: linear-gradient(135deg, #475569, #1e293b); border: 1px solid rgba(15, 23, 42, 0.15); color: #ffffff;
         @endif
         ">

        @if($option === 'icon')
            {{-- OPTION B: Vector Office Building / Briefcase Icon --}}
            <svg width="{{ $iconSize }}" height="{{ $iconSize }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/>
                <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/>
                <path d="M10 6h4"/>
                <path d="M10 10h4"/>
                <path d="M10 14h4"/>
                <path d="M10 18h4"/>
            </svg>
        @else
            {{-- OPTION A: Company Name Initials Badge --}}
            <span style="font-size: {{ $fontSize }}px; font-weight: 700; letter-spacing: 0.5px; line-height: 1; font-family: inherit;">
                {{ $initials }}
            </span>
        @endif
    </div>
</div>
