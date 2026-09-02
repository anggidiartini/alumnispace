<!doctype html>
<html lang="id"><head><script>window["__codeletBootstrap__"]=JSON.parse('{"A":"A","B":"20260902-01-0b0be00","C":{"Abril Fatface":"YACgEZbkUVE,0","Alfa Slab One":"YACgEYS9sJU,0","Anton":"YACgEcYqQ-A,0","Archivo":"YAHO2-t-jNE,0","Arial":"YAGyDvJ_4Ts,0","Bebas Neue":"YACgESME5ew,0","Bricolage Grotesque":"YAFyMcdwzpc,0","Canva Sans":"YAFLd8sKbwc,2","Caveat":"YALBs2ploWQ,0","Comic Sans MS":"YAHO2VMiyZo,0","Cormorant Garamond":"YAFdJhX-538,0","Courier New":"YAGzXiGs0_8,0","DM Sans":"YAD1aU3sLnI,0","DM Serif Display":"YAD1aYG82rc,0","Forum":"YACgEcnnqB4,0","Fraunces":"YAEul-FRQw4,0","Georgia":"YAGzXkO0pEM,0","Helvetica Neue":"YAFcf6CtJfI,0","Impact":"YAFcfnjI7Vk,0","Inter":"YAFdJvSyp_k,3","Iowan Old Style":"YAGNIFa8j9o,0","Jacques Francois":"YAHO2a5g66Q,0","JetBrains Mono":"YAFdJksXcAk,0","Libre Baskerville":"YACgEUFdPdA,0","Manrope":"YAHO2b2feC4,0","Merriweather":"YACgEXvHxxs,0","Montserrat":"YADLjI9qxTA,0","Nunito":"YACgEX8C5Gg,0","Oleo Script":"YACgEQQ14jI,0","Phantom Sans":"YAHO2E8Pb88,0","Playfair Display":"YACgEYmuCJE,0","Poppins":"YAFdJjbTu24,1","Press Start 2P":"YAFyGr-8pmQ,0","Quicksand":"YADWjpfPmdk,0","Raleway":"YACgEVg3xZg,0","Segoe UI":"YAHNdRD1Klw,0","Source Sans 3":"YAG4lO1Mj10,0","Spectral":"YAHO2rVUHIM,0","Times New Roman":"YAGzXW3gftg,0","Times":"YAGzXW3gftg,0","Ubuntu":"YACgERDU--Q,0","Work Sans":"YAGXhLOKv44,0","Yellowtail":"YACgEYG4kG4,0","ui-monospace":"YADlN8CFZ8Q,0","ui-sans-serif":"YACkoN-xg4g,0"}}');</script><script src="/_sdk/50d846425a1e5082.telemetry_sdk.js" integrity="sha512-Otbex+ztlVbcEGql0rXGd/3E3ee/hqAntg6DeuUEMG6pIPbXGOSvZbFZVzknAXi1tH/itQ+ijEhOTr2aWj6CXg=="></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumni Space Career Hub</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&amp;family=Fraunces:opsz,wght@9..144,600;9..144,700&amp;display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <style>
    :root {
      --navy: #153a68;
      --blue: #3478e5;
      --cream: #fffdf6;
      --yellow: #ffd84a;
      --pink: #ff9eb4;
      --ink: #19355a;
      --muted: #55708d;
      --line: #dce5ef;
      --card: #ffffff;
      --soft-blue: #eaf2ff;
      --shadow: 0 12px 28px rgba(28, 61, 104, 0.09);
      --shadow-lifted: 0 18px 34px rgba(28, 61, 104, 0.14);
      --radius-large: 1.75rem;
      --radius-medium: 1.35rem;
    }

    * {
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      width: 100%;
      min-width: 0;
      margin: 0;
      color: var(--ink);
      background-color: var(--cream);
      background-image:
        linear-gradient(rgba(21, 58, 104, 0.045) 1px, transparent 1px),
        linear-gradient(90deg, rgba(21, 58, 104, 0.045) 1px, transparent 1px);
      background-size: 24px 24px;
      font-family: "DM Sans", sans-serif;
    }

    button,
    input,
    select {
      font: inherit;
    }

    button,
    a,
    select,
    input {
      outline-offset: 3px;
    }

    button:focus-visible,
    a:focus-visible,
    select:focus-visible,
    input:focus-visible {
      outline: 3px solid var(--pink);
    }

    a {
      color: inherit;
    }

    .site-shell {
      width: 100%;
      overflow: hidden;
    }

    .page-width {
      width: min(100% - 2.5rem, 1180px);
      margin: 0 auto;
    }

    .site-header {
      position: sticky;
      top: 0;
      z-index: 20;
      border-bottom: 1px solid var(--line);
      background: rgba(255, 253, 246, 0.95);
      backdrop-filter: blur(14px);
    }

    .header-inner {
      display: flex;
      min-height: 72px;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
    }

    .brand-link {
      display: inline-flex;
      align-items: center;
      gap: 0.65rem;
      text-decoration: none;
    }

    .brand-mark {
      display: grid;
      width: 2.25rem;
      height: 2.25rem;
      place-items: center;
      border-radius: 0.75rem;
      background: var(--blue);
      box-shadow: 3px 3px 0 var(--yellow);
      color: white;
      font-weight: 800;
    }

    .desktop-nav {
      display: flex;
      align-items: center;
      gap: 1.7rem;
    }

    .nav-link {
      color: #456180;
      font-size: 0.9rem;
      font-weight: 700;
      text-decoration: none;
      transition: color 180ms ease;
    }

    .nav-link:hover {
      color: var(--blue);
    }

    .header-action,
    .primary-button,
    .apply-button,
    .reset-button,
    .back-button,
    .filter-chip {
      border: 0;
      cursor: pointer;
      text-decoration: none;
      transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease, color 180ms ease;
    }

    .header-action {
      border-radius: 0.8rem;
      padding: 0.65rem 1rem;
    }

    .header-tools {
      display: flex;
      align-items: center;
      gap: 0.7rem;
    }

    .back-button {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      border: 1px solid #cddbea;
      border-radius: 0.8rem;
      padding: 0.56rem 0.75rem;
      background: white;
      color: var(--navy);
      font-size: 0.82rem;
      font-weight: 800;
    }

    .back-button:hover,
    .header-action:hover,
    .primary-button:hover,
    .apply-button:hover {
      transform: translateY(-2px);
    }

    .menu-toggle {
      display: none;
      width: 2.5rem;
      height: 2.5rem;
      place-items: center;
      border: 1px solid #cfdceb;
      border-radius: 0.75rem;
      background: white;
      color: var(--navy);
      cursor: pointer;
    }

    .mobile-nav {
      display: none;
      border-top: 1px solid var(--line);
      padding: 1rem 0;
    }

    .mobile-nav.is-open {
      display: block;
    }

    .mobile-nav-inner {
      display: grid;
      gap: 0.85rem;
    }

    .hero-section {
      padding: 4rem 0;
    }

    .hero-layout {
      display: grid;
      align-items: center;
      gap: 2.5rem;
      grid-template-columns: 1.02fr 0.98fr;
    }

    .hero-copy,
    .hero-board {
      animation: rise 560ms ease both;
    }

    .hero-board {
      position: relative;
      min-height: 360px;
      overflow: hidden;
      border-radius: 2rem;
      padding: 2.5rem;
      background: var(--blue);
      box-shadow: 0 20px 0 rgba(255, 216, 74, 0.65), 0 28px 45px rgba(25, 53, 90, 0.16);
      animation-delay: 120ms;
    }

    .hero-board::before {
      position: absolute;
      inset: 0;
      background-image: radial-gradient(#fff 1.2px, transparent 1.2px);
      background-size: 13px 13px;
      content: "";
      opacity: 0.22;
    }

    .hero-orb {
      position: absolute;
      border-radius: 999px;
    }

    .hero-orb-yellow {
      top: -18px;
      right: -18px;
      width: 7rem;
      height: 7rem;
      background: var(--yellow);
    }

    .hero-orb-pink {
      bottom: 2rem;
      left: 1rem;
      width: 3.5rem;
      height: 3.5rem;
      background: var(--pink);
    }

    .hero-star {
      position: absolute;
      right: 2rem;
      bottom: 2rem;
      color: var(--yellow);
      font-size: 2.3rem;
      transform: rotate(12deg);
    }

    .eyebrow {
      display: inline-flex;
      border-radius: 999px;
      padding: 0.36rem 0.75rem;
    }

    .hero-title {
      max-width: 40rem;
      margin: 1.2rem 0 0;
      font-family: "Fraunces", serif;
      font-size: clamp(2.2rem, 5vw, 4.4rem);
      line-height: 1.02;
      letter-spacing: -0.045em;
    }

    .hero-description {
      max-width: 34rem;
      margin: 1.25rem 0 0;
      line-height: 1.7;
    }

    .primary-button {
      display: inline-flex;
      align-items: center;
      gap: 0.6rem;
      margin-top: 2rem;
      border-radius: 1rem;
      padding: 0.85rem 1.25rem;
      box-shadow: 4px 4px 0 var(--yellow);
    }

    .social-proof {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-top: 2.25rem;
      color: var(--muted);
      font-size: 0.9rem;
      font-weight: 600;
    }

    .avatar-stack {
      display: flex;
    }

    .avatar-dot {
      width: 2rem;
      height: 2rem;
      margin-left: -0.45rem;
      border: 2px solid var(--cream);
      border-radius: 50%;
    }

    .avatar-dot:first-child {
      margin-left: 0;
      background: var(--pink);
    }

    .avatar-dot:nth-child(2) {
      background: var(--yellow);
    }

    .avatar-dot:nth-child(3) {
      background: var(--blue);
    }

    .preview-wrap {
      position: relative;
      z-index: 1;
      max-width: 25rem;
      margin: 0 auto;
      padding-top: 1rem;
    }

    .preview-label {
      display: inline-block;
      margin-bottom: 1rem;
      border-radius: 0.45rem;
      padding: 0.3rem 0.75rem;
      font-size: 0.65rem;
      letter-spacing: 0.1em;
    }

    .preview-card {
      border-radius: 1.5rem;
      padding: 1.25rem;
      transform: rotate(-3deg);
    }

    .preview-top {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 2rem;
    }

    .preview-monogram {
      display: grid;
      width: 3rem;
      height: 3rem;
      place-items: center;
      border-radius: 1rem;
      background: var(--pink);
      color: var(--navy);
      font-weight: 800;
    }

    .progress-track {
      height: 0.5rem;
      margin-top: 1.25rem;
      overflow: hidden;
      border-radius: 999px;
      background: #dce6f5;
    }

    .progress-bar {
      width: 75%;
      height: 100%;
      border-radius: inherit;
      background: var(--blue);
    }

    .hero-note {
      position: absolute;
      right: -1.25rem;
      bottom: -2.25rem;
      border-radius: 0.75rem;
      padding: 0.75rem 1rem;
      box-shadow: var(--shadow);
      transform: rotate(3deg);
    }

    .jobs-section {
      padding-bottom: 5rem;
    }

    .section-heading {
      display: flex;
      flex-wrap: wrap;
      align-items: end;
      justify-content: space-between;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .section-kicker {
      margin: 0;
      font-size: 0.85rem;
      letter-spacing: 0.15em;
      text-transform: uppercase;
    }

    .section-title {
      margin: 0.45rem 0 0;
      font-family: "Fraunces", serif;
      font-size: clamp(1.8rem, 3vw, 2.5rem);
      letter-spacing: -0.03em;
    }

    .jobs-note {
      border: 1px solid #d7e2ee;
      border-radius: 999px;
      padding: 0.55rem 1rem;
      font-size: 0.88rem;
    }

    .jobs-layout {
      display: grid;
      gap: 1.75rem;
      grid-template-columns: 270px minmax(0, 1fr);
    }

    .filter-panel {
      height: fit-content;
      border-radius: var(--radius-large);
      padding: 1.25rem;
      box-shadow: var(--shadow);
    }

    .filter-panel-heading {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1.25rem;
    }

    .filter-form {
      display: grid;
      gap: 1.25rem;
    }

    .field-label {
      display: block;
      margin-bottom: 0.5rem;
      font-size: 0.9rem;
    }

    .field-control {
      width: 100%;
      border: 1px solid #cddbea;
      border-radius: 0.75rem;
      padding: 0.78rem;
      background: white;
      color: var(--navy);
    }

    .search-wrap {
      position: relative;
    }

    .search-wrap svg {
      position: absolute;
      top: 0.8rem;
      left: 0.75rem;
      color: #66809c;
    }

    .search-wrap .field-control {
      padding-left: 2.55rem;
    }

    .chip-list {
      display: flex;
      flex-wrap: wrap;
      gap: 0.45rem;
    }

    .filter-chip {
      border: 1.5px solid #d4dfed;
      border-radius: 999px;
      padding: 0.55rem 0.75rem;
      background: white;
      color: var(--navy);
      font-size: 0.75rem;
    }

    .filter-chip.is-active {
      border-color: var(--navy);
      background: var(--navy);
      box-shadow: 3px 3px 0 var(--yellow);
      color: white;
    }

    .reset-button {
      width: 100%;
      border: 2px solid var(--navy);
      border-radius: 0.75rem;
      padding: 0.75rem;
      background: white;
      color: var(--navy);
    }

    .reset-button:hover {
      background: var(--navy);
      color: white;
    }

    .results-header {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      gap: 0.75rem;
      margin-bottom: 1.25rem;
    }

    .results-count {
      margin: 0;
      font-weight: 800;
    }

    .filter-summary {
      margin: 0;
      border-radius: 999px;
      padding: 0.5rem 0.75rem;
      background: var(--soft-blue);
      color: #35608f;
      font-size: 0.75rem;
      font-weight: 700;
    }

    .jobs-grid {
      display: grid;
      gap: 1.25rem;
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .job-card {
      border-radius: var(--radius-medium);
      padding: 1.25rem;
      background: white;
      box-shadow: var(--shadow);
      transition: transform 220ms ease, box-shadow 220ms ease;
    }

    .job-card:hover {
      box-shadow: var(--shadow-lifted);
      transform: translateY(-5px) rotate(-0.3deg);
    }

    .job-card.is-hidden {
      display: none;
    }

    .job-card-head {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 0.75rem;
    }

    .job-symbol {
      color: var(--blue);
      font-size: 1.2rem;
    }

    .job-badge {
      display: inline-block;
      border-radius: 999px;
      padding: 0.3rem 0.75rem;
      font-size: 0.72rem;
    }

    .job-title-link {
      display: inline-block;
      margin-top: 1.25rem;
      font-size: 1.28rem;
      line-height: 1.2;
      text-decoration: none;
    }

    .job-title-link:hover,
    .company-link:hover {
      text-decoration: underline;
    }

    .company-link {
      display: inline-block;
      margin-top: 0.55rem;
      color: var(--blue);
      font-size: 0.9rem;
      text-decoration-color: var(--pink);
      text-decoration-thickness: 2px;
      text-underline-offset: 4px;
    }

    .job-meta,
    .job-description {
      margin: 0.8rem 0 0;
      font-size: 0.9rem;
    }

    .job-description {
      line-height: 1.6;
    }

    .apply-button {
      display: inline-flex;
      margin-top: 1.25rem;
      border-radius: 0.75rem;
      padding: 0.68rem 1rem;
    }

    .empty-state {
      display: none;
      border: 2px dashed #b9cce1;
      border-radius: var(--radius-large);
      padding: 3.5rem 1.5rem;
      background: rgba(255, 255, 255, 0.7);
      text-align: center;
    }

    .empty-state.is-visible {
      display: block;
    }

    .empty-icon {
      display: grid;
      width: 3.5rem;
      height: 3.5rem;
      margin: 0 auto;
      place-items: center;
      border-radius: 50%;
      background: #ffe1e8;
      font-size: 1.5rem;
    }

    .ticket-banner {
      position: relative;
      margin-top: 2rem;
      overflow: hidden;
      border-radius: 1.65rem;
      padding: 2rem;
      color: white;
    }

    .ticket-banner::before,
    .ticket-banner::after {
      position: absolute;
      left: 34%;
      width: 2rem;
      height: 2rem;
      border-radius: 50%;
      background: var(--cream);
      content: "";
    }

    .ticket-banner::before {
      top: -1rem;
    }

    .ticket-banner::after {
      bottom: -1rem;
    }

    .ticket-divider {
      position: absolute;
      top: 1rem;
      bottom: 1rem;
      left: 34%;
      border-left: 2px dashed rgba(255, 255, 255, 0.75);
    }

    .ticket-content {
      position: relative;
      display: grid;
      align-items: center;
      gap: 1.5rem;
      grid-template-columns: 1fr auto;
    }

    .ticket-copy {
      padding-right: 4rem;
    }

    .ticket-title {
      margin: 0.45rem 0 0;
      font-family: "Fraunces", serif;
      font-size: clamp(1.55rem, 3vw, 2.15rem);
    }

    .ticket-description {
      max-width: 42rem;
      margin: 0.55rem 0 0;
      line-height: 1.6;
    }

    .ticket-cta {
      display: inline-flex;
      border-radius: 1rem;
      padding: 0.85rem 1.2rem;
      box-shadow: 4px 4px 0 var(--pink);
      text-decoration: none;
    }

    .site-footer {
      border-top: 1px solid var(--line);
      padding: 2rem 0;
      background: white;
    }

    .footer-inner {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 0.75rem;
    }

    .footer-inner p {
      margin: 0;
      font-size: 0.9rem;
    }

    @keyframes rise {
      from {
        opacity: 0;
        transform: translateY(18px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 900px) {
      .hero-layout,
      .jobs-layout {
        grid-template-columns: 1fr;
      }

      .filter-panel {
        position: static;
      }
    }

    @media (max-width: 720px) {
      .page-width {
        width: min(100% - 2rem, 1180px);
      }

      .desktop-nav,
      .header-action {
        display: none;
      }

      .menu-toggle {
        display: grid;
      }

      .hero-section {
        padding: 2.5rem 0 3.5rem;
      }

      .hero-board {
        min-height: 315px;
        padding: 1.5rem;
      }

      .jobs-grid {
        grid-template-columns: 1fr;
      }

      .ticket-content {
        grid-template-columns: 1fr;
      }

      .ticket-copy {
        padding-right: 0;
      }

      .ticket-banner::before,
      .ticket-banner::after {
        top: 34%;
        left: auto;
      }

      .ticket-banner::before {
        right: -1rem;
      }

      .ticket-banner::after {
        bottom: auto;
        left: -1rem;
      }

      .ticket-divider {
        top: 34%;
        right: 1rem;
        bottom: auto;
        left: 1rem;
        border-top: 2px dashed rgba(255, 255, 255, 0.75);
        border-left: 0;
      }
    }

    @media (max-width: 430px) {
      .back-button span {
        display: none;
      }

      .hero-title {
        font-size: 2.3rem;
      }

      .social-proof {
        align-items: flex-start;
      }
    }

    @media (prefers-reduced-motion: reduce) {
      *,
      *::before,
      *::after {
        scroll-behavior: auto !important;
        animation-duration: 0.01ms !important;
        transition-duration: 0.01ms !important;
      }
    }
  </style>
  <script src="https://cdn.tailwindcss.com/3.4.17" type="text/javascript"></script>
  <script src="/_sdk/b3bf9e8ac58e6ad6.data_sdk.js" type="text/javascript" integrity="sha512-otc1u9NYq9Ms5Jt//7vmhrrqR5CLPr8Jdgs6741gqniClfLMcfmC+jK/cKuQdhLv6G0esJ/FzaMS9tv0T/vj/Q=="></script>
  <script src="/_sdk/85d8138ba0e9799c.resizing_sdk.js" type="text/javascript" integrity="sha512-8dt8XK3OsxyrL/A/AlNWHjY+utLvSBcXg410ejaLzAIOVGDj1jNmEYRbymhdzToKhNo0uO9dxAmMLwHQseh3Lw=="></script>
 </head>
 <body data-template-id="__page-root" style="background: rgb(255, 253, 246);">
  <div class="site-shell">
   <header data-template-id="header-section" class="site-header canva-header" style="background: rgb(255, 253, 246);">
    <div class="page-width header-inner"><a class="brand-link" href="/lowongan" aria-label="Alumni Space Career Hub"> <span class="brand-mark">A</span> <span data-template-id="wordmark" class="canva-text" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 20px;">Alumni Space</span> </a>
     <nav class="desktop-nav" aria-label="Navigasi utama"><a data-template-id="nav-home" class="canva-link nav-link" href="/lowongan" style="color: rgb(69, 97, 128); font-weight: 700; font-style: normal; font-size: 16px;">Beranda</a> <a data-template-id="nav-community" class="canva-link nav-link" href="/lowongan" style="color: rgb(69, 97, 128); font-weight: 700; font-style: normal; font-size: 16px;">Komunitas</a> <a data-template-id="nav-jobs" class="canva-link nav-link" href="/lowongan" style="color: rgb(69, 97, 128); font-weight: 700; font-style: normal; font-size: 16px;">Lowongan</a> <a data-template-id="nav-stories" class="canva-link nav-link" href="/lowongan" style="color: rgb(69, 97, 128); font-weight: 700; font-style: normal; font-size: 16px;">Cerita Alumni</a> <a data-template-id="login-button" class="canva-button header-action" href="/lowongan" style="background: rgb(21, 58, 104); color: rgb(255, 255, 255); font-weight: 700; font-style: normal; font-size: 16px;">Masuk</a>
     </nav>
     <div class="header-tools"><button id="back-button" class="back-button" type="button" aria-label="Kembali ke halaman sebelumnya"> <i data-lucide="arrow-left" width="16" height="16"></i> <span>Kembali</span> </button> <button id="menu-toggle" class="menu-toggle" type="button" aria-label="Buka menu navigasi" aria-expanded="false"> <i data-lucide="menu" width="20" height="20"></i> </button>
     </div>
    </div>
    <nav id="mobile-nav" class="mobile-nav" aria-label="Navigasi seluler">
     <div class="page-width mobile-nav-inner"><a data-template-id="mobile-nav-home" class="canva-link nav-link" href="/lowongan" style="color: rgb(69, 97, 128); font-weight: 700; font-style: normal; font-size: 16px;">Beranda</a> <a data-template-id="mobile-nav-community" class="canva-link nav-link" href="/lowongan" style="color: rgb(69, 97, 128); font-weight: 700; font-style: normal; font-size: 16px;">Komunitas</a> <a data-template-id="mobile-nav-jobs" class="canva-link nav-link" href="/lowongan" style="color: rgb(69, 97, 128); font-weight: 700; font-style: normal; font-size: 16px;">Lowongan</a> <a data-template-id="mobile-nav-stories" class="canva-link nav-link" href="/lowongan" style="color: rgb(69, 97, 128); font-weight: 700; font-style: normal; font-size: 16px;">Cerita Alumni</a>
     </div>
    </nav>
   </header>
   <main>
    <section class="page-width hero-section" aria-labelledby="hero-title">
     <div class="hero-layout">
      <div class="hero-copy">
       <p data-template-id="hero-label" class="canva-tag eyebrow" style="background: rgb(255, 241, 180); color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 12px; letter-spacing: 0.08rem;">ALUMNI SPACE CAREER HUB</p>
       <h1 data-template-id="hero-title" id="hero-title" class="canva-text hero-title" style="color: rgb(21, 58, 104); font-weight: 700; font-style: normal; font-size: 32px;">Temukan langkah karier berikutnya</h1>
       <p data-template-id="hero-description" class="canva-text hero-description" style="color: rgb(79, 109, 139); font-weight: 400; font-style: normal; font-size: 17px; line-height: 1.6;">Temukan peluang kerja yang relevan dari perusahaan terpercaya—dibagikan khusus untuk komunitas alumni yang terus bertumbuh.</p><a data-template-id="hero-button" class="canva-button primary-button" href="/lowongan" style="background: rgb(52, 120, 229); color: rgb(255, 255, 255); font-weight: 800; font-style: normal; font-size: 16px;">Jelajahi Lowongan</a>
       <div class="social-proof">
        <div class="avatar-stack" aria-hidden="true"><span class="avatar-dot"></span> <span class="avatar-dot"></span> <span class="avatar-dot"></span>
        </div><span data-template-id="hero-social-proof" class="canva-text" style="color: rgb(85, 112, 141); font-weight: 600; font-style: normal; font-size: 16px;">Peluang baru setiap minggu</span>
       </div>
      </div>
      <div class="hero-board" aria-label="Sorotan lowongan"><span class="hero-orb hero-orb-yellow" aria-hidden="true"></span> <span class="hero-orb hero-orb-pink" aria-hidden="true"></span> <span class="hero-star" aria-hidden="true">✦</span>
       <div class="preview-wrap">
        <div data-template-id="hero-mini-label" class="canva-tag preview-label" style="background: rgb(255, 255, 255); color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">PILIHAN MINGGU INI</div>
        <article data-template-id="hero-job-preview" class="canva-card preview-card" style="background: rgb(255, 253, 246);">
         <div class="preview-top">
          <div class="preview-monogram">
           RK
          </div><span data-template-id="hero-preview-badge" class="canva-tag job-badge" style="background: rgb(255, 216, 74); color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Remote</span>
         </div>
         <h2 data-template-id="hero-preview-title" class="canva-text" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 23px;">Product Designer</h2>
         <p data-template-id="hero-preview-company" class="canva-text" style="color: rgb(83, 113, 143); font-weight: 700; font-style: normal; font-size: 16px;">Ruang Kreatif · Jakarta</p>
         <div class="progress-track" aria-hidden="true">
          <div class="progress-bar"></div>
         </div>
        </article>
        <div data-template-id="hero-note" class="canva-banner hero-note" style="background: rgb(255, 158, 180); color: rgb(21, 58, 104); font-weight: 700; font-style: normal; font-size: 16px;">Ada peluang baru!</div>
       </div>
      </div>
     </div>
    </section>
    <section class="page-width jobs-section" aria-labelledby="jobs-title">
     <div class="section-heading">
      <div>
       <p data-template-id="jobs-kicker" class="canva-text section-kicker" style="color: rgb(52, 120, 229); font-weight: 800; font-style: normal; font-size: 16px;">Papan peluang</p>
       <h2 data-template-id="jobs-title" id="jobs-title" class="canva-text section-title" style="color: rgb(21, 58, 104); font-weight: 700; font-style: normal; font-size: 24px;">Lowongan aktif untukmu</h2>
      </div><span data-template-id="jobs-note" class="canva-tag jobs-note" style="background: rgb(255, 255, 255); color: rgb(83, 113, 143); font-weight: 600; font-style: normal; font-size: 16px;">Diperbarui secara berkala</span>
     </div>
     <div class="jobs-layout">
      <aside data-template-id="filter-panel" class="canva-panel filter-panel" aria-label="Filter lowongan" style="background: rgb(255, 255, 255);">
       <div class="filter-panel-heading">
        <h3 data-template-id="filter-title" class="canva-text" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 19px;">Filter Lowongan</h3><i data-lucide="sliders-horizontal" width="19" height="19"></i>
       </div>
       <form class="filter-form" id="filter-form">
        <div><label data-template-id="search-label" class="canva-text field-label" for="search-input" style="color: rgb(21, 58, 104); font-weight: 700; font-style: normal; font-size: 16px;">Cari peluang</label>
         <div class="search-wrap"><i data-lucide="search" width="18" height="18"></i> <input data-template-id="search-input" id="search-input" class="canva-input field-control" type="search" placeholder="Cari posisi atau kata kunci" style="color: rgb(21, 58, 104); font-weight: 400; font-style: normal; font-size: 16px;">
         </div>
        </div>
        <div><label data-template-id="company-label" class="canva-text field-label" for="company-filter" style="color: rgb(21, 58, 104); font-weight: 700; font-style: normal; font-size: 16px;">Perusahaan</label> <select id="company-filter" class="field-control"> <option value="">Semua Perusahaan</option> <option value="Ruang Kreatif">Ruang Kreatif</option> <option value="Nusantara Labs">Nusantara Labs</option> <option value="Kawan Studio">Kawan Studio</option> <option value="Satu Data">Satu Data</option> <option value="Pasar Hijau">Pasar Hijau</option> <option value="Orbit People">Orbit People</option> </select>
        </div>
        <div><label data-template-id="location-label" class="canva-text field-label" for="location-filter" style="color: rgb(21, 58, 104); font-weight: 700; font-style: normal; font-size: 16px;">Lokasi</label> <select id="location-filter" class="field-control"> <option value="">Semua Lokasi</option> <option value="Jakarta">Jakarta</option> <option value="Bandung">Bandung</option> <option value="Remote">Remote</option> <option value="Surabaya">Surabaya</option> <option value="Yogyakarta">Yogyakarta</option> </select>
        </div>
        <div>
         <p data-template-id="category-label" class="canva-text field-label" style="color: rgb(21, 58, 104); font-weight: 700; font-style: normal; font-size: 16px;">Kategori cepat</p>
         <div class="chip-list"><button data-template-id="chip-fulltime" class="canva-button filter-chip" data-type="Full-Time" type="button" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Full-Time</button> <button data-template-id="chip-remote" class="canva-button filter-chip" data-type="Remote" type="button" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Remote</button> <button data-template-id="chip-freelance" class="canva-button filter-chip" data-type="Freelance" type="button" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Freelance</button> <button data-template-id="chip-intern" class="canva-button filter-chip" data-type="Magang" type="button" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Magang</button>
         </div>
        </div><button data-template-id="reset-filter-button" id="reset-filter" class="canva-button reset-button" type="button" style="background: rgb(255, 255, 255); color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Reset Filter</button>
       </form>
      </aside>
      <div>
       <div class="results-header">
        <p id="results-count" class="results-count" aria-live="polite"></p>
        <p id="filter-summary" class="filter-summary" aria-live="polite"></p>
       </div>
       <div id="jobs-grid" class="jobs-grid">
        <article class="job-card" data-company="Ruang Kreatif" data-location="Jakarta" data-type="Full-Time" data-search="product designer ruang kreatif jakarta full time desain produk aplikasi digital">
         <div class="job-card-head">
          <span data-template-id="job1-badge" class="canva-tag job-badge" style="background: rgb(255, 226, 168); color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Desain</span><span class="job-symbol">✳</span>
         </div><a data-template-id="job1-title" class="canva-link job-title-link" href="/lowongan/detail/product-designer" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 21px;">Product Designer</a> <a data-template-id="job1-company" class="canva-link company-link" href="/lowongan/detail/product-designer" style="color: rgb(52, 120, 229); font-weight: 700; font-style: normal; font-size: 16px;">Ruang Kreatif</a>
         <p data-template-id="job1-meta" class="canva-text job-meta" style="color: rgb(92, 120, 148); font-weight: 600; font-style: normal; font-size: 16px;">Jakarta · Full-Time · 2 hari lalu</p>
         <p data-template-id="job1-description" class="canva-text job-description" style="color: rgb(84, 112, 141); font-weight: 400; font-style: normal; font-size: 16px;">Rancang pengalaman produk digital yang hangat dan mudah digunakan.</p><a data-template-id="job1-apply" class="canva-button apply-button" href="/lowongan/detail/product-designer" style="background: rgb(21, 58, 104); color: rgb(255, 255, 255); font-weight: 800; font-style: normal; font-size: 16px;">Lamar</a>
        </article>
        <article class="job-card" data-company="Nusantara Labs" data-location="Bandung" data-type="Remote" data-search="frontend developer nusantara labs bandung remote react javascript teknologi">
         <div class="job-card-head">
          <span data-template-id="job2-badge" class="canva-tag job-badge" style="background: rgb(219, 234, 255); color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Teknologi</span><span class="job-symbol">⌘</span>
         </div><a data-template-id="job2-title" class="canva-link job-title-link" href="/lowongan/detail/frontend-developer" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 21px;">Frontend Developer</a> <a data-template-id="job2-company" class="canva-link company-link" href="/lowongan/detail/frontend-developer" style="color: rgb(52, 120, 229); font-weight: 700; font-style: normal; font-size: 16px;">Nusantara Labs</a>
         <p data-template-id="job2-meta" class="canva-text job-meta" style="color: rgb(92, 120, 148); font-weight: 600; font-style: normal; font-size: 16px;">Bandung · Remote · 3 hari lalu</p>
         <p data-template-id="job2-description" class="canva-text job-description" style="color: rgb(84, 112, 141); font-weight: 400; font-style: normal; font-size: 16px;">Bangun antarmuka web cepat dan rapi bersama tim produk kolaboratif.</p><a data-template-id="job2-apply" class="canva-button apply-button" href="/lowongan/detail/frontend-developer" style="background: rgb(21, 58, 104); color: rgb(255, 255, 255); font-weight: 800; font-style: normal; font-size: 16px;">Lamar</a>
        </article>
        <article class="job-card" data-company="Kawan Studio" data-location="Jakarta" data-type="Full-Time" data-search="community manager kawan studio jakarta full time komunitas event engagement">
         <div class="job-card-head">
          <span data-template-id="job3-badge" class="canva-tag job-badge" style="background: rgb(255, 224, 232); color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Komunitas</span><span class="job-symbol">☻</span>
         </div><a data-template-id="job3-title" class="canva-link job-title-link" href="/lowongan/detail/community-manager" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 21px;">Community Manager</a> <a data-template-id="job3-company" class="canva-link company-link" href="/lowongan/detail/community-manager" style="color: rgb(52, 120, 229); font-weight: 700; font-style: normal; font-size: 16px;">Kawan Studio</a>
         <p data-template-id="job3-meta" class="canva-text job-meta" style="color: rgb(92, 120, 148); font-weight: 600; font-style: normal; font-size: 16px;">Jakarta · Full-Time · 4 hari lalu</p>
         <p data-template-id="job3-description" class="canva-text job-description" style="color: rgb(84, 112, 141); font-weight: 400; font-style: normal; font-size: 16px;">Rawat percakapan, program, dan hubungan bermakna di komunitas kreatif.</p><a data-template-id="job3-apply" class="canva-button apply-button" href="/lowongan/detail/community-manager" style="background: rgb(21, 58, 104); color: rgb(255, 255, 255); font-weight: 800; font-style: normal; font-size: 16px;">Lamar</a>
        </article>
        <article class="job-card" data-company="Satu Data" data-location="Remote" data-type="Full-Time" data-search="data analyst satu data remote full time sql dashboard insight bisnis">
         <div class="job-card-head">
          <span data-template-id="job4-badge" class="canva-tag job-badge" style="background: rgb(224, 246, 232); color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Data</span><span class="job-symbol">◫</span>
         </div><a data-template-id="job4-title" class="canva-link job-title-link" href="/lowongan/detail/data-analyst" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 21px;">Data Analyst</a> <a data-template-id="job4-company" class="canva-link company-link" href="/lowongan/detail/data-analyst" style="color: rgb(52, 120, 229); font-weight: 700; font-style: normal; font-size: 16px;">Satu Data</a>
         <p data-template-id="job4-meta" class="canva-text job-meta" style="color: rgb(92, 120, 148); font-weight: 600; font-style: normal; font-size: 16px;">Remote · Full-Time · 5 hari lalu</p>
         <p data-template-id="job4-description" class="canva-text job-description" style="color: rgb(84, 112, 141); font-weight: 400; font-style: normal; font-size: 16px;">Ubah data menjadi insight untuk keputusan bisnis yang lebih baik.</p><a data-template-id="job4-apply" class="canva-button apply-button" href="/lowongan/detail/data-analyst" style="background: rgb(21, 58, 104); color: rgb(255, 255, 255); font-weight: 800; font-style: normal; font-size: 16px;">Lamar</a>
        </article>
        <article class="job-card" data-company="Pasar Hijau" data-location="Yogyakarta" data-type="Freelance" data-search="copywriter pasar hijau yogyakarta freelance konten brand kampanye">
         <div class="job-card-head">
          <span data-template-id="job5-badge" class="canva-tag job-badge" style="background: rgb(255, 226, 168); color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Konten</span><span class="job-symbol">✎</span>
         </div><a data-template-id="job5-title" class="canva-link job-title-link" href="/lowongan/detail/copywriter" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 21px;">Copywriter</a> <a data-template-id="job5-company" class="canva-link company-link" href="/lowongan/detail/copywriter" style="color: rgb(52, 120, 229); font-weight: 700; font-style: normal; font-size: 16px;">Pasar Hijau</a>
         <p data-template-id="job5-meta" class="canva-text job-meta" style="color: rgb(92, 120, 148); font-weight: 600; font-style: normal; font-size: 16px;">Yogyakarta · Freelance · 1 hari lalu</p>
         <p data-template-id="job5-description" class="canva-text job-description" style="color: rgb(84, 112, 141); font-weight: 400; font-style: normal; font-size: 16px;">Ciptakan suara brand yang segar untuk kampanye produk ramah lingkungan.</p><a data-template-id="job5-apply" class="canva-button apply-button" href="/lowongan/detail/copywriter" style="background: rgb(21, 58, 104); color: rgb(255, 255, 255); font-weight: 800; font-style: normal; font-size: 16px;">Lamar</a>
        </article>
        <article class="job-card" data-company="Ruang Kreatif" data-location="Remote" data-type="Full-Time" data-search="ux researcher ruang kreatif remote full time riset pengguna produk">
         <div class="job-card-head">
          <span data-template-id="job6-badge" class="canva-tag job-badge" style="background: rgb(219, 234, 255); color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Riset</span><span class="job-symbol">◉</span>
         </div><a data-template-id="job6-title" class="canva-link job-title-link" href="/lowongan/detail/ux-researcher" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 21px;">UX Researcher</a> <a data-template-id="job6-company" class="canva-link company-link" href="/lowongan/detail/ux-researcher" style="color: rgb(52, 120, 229); font-weight: 700; font-style: normal; font-size: 16px;">Ruang Kreatif</a>
         <p data-template-id="job6-meta" class="canva-text job-meta" style="color: rgb(92, 120, 148); font-weight: 600; font-style: normal; font-size: 16px;">Remote · Full-Time · 6 hari lalu</p>
         <p data-template-id="job6-description" class="canva-text job-description" style="color: rgb(84, 112, 141); font-weight: 400; font-style: normal; font-size: 16px;">Temukan kebutuhan pengguna melalui riset yang tajam dan penuh empati.</p><a data-template-id="job6-apply" class="canva-button apply-button" href="/lowongan/detail/ux-researcher" style="background: rgb(21, 58, 104); color: rgb(255, 255, 255); font-weight: 800; font-style: normal; font-size: 16px;">Lamar</a>
        </article>
        <article class="job-card" data-company="Orbit People" data-location="Surabaya" data-type="Full-Time" data-search="hr specialist orbit people surabaya full time sumber daya manusia rekrutmen">
         <div class="job-card-head">
          <span data-template-id="job7-badge" class="canva-tag job-badge" style="background: rgb(255, 224, 232); color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">People</span><span class="job-symbol">♡</span>
         </div><a data-template-id="job7-title" class="canva-link job-title-link" href="/lowongan/detail/hr-specialist" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 21px;">HR Specialist</a> <a data-template-id="job7-company" class="canva-link company-link" href="/lowongan/detail/hr-specialist" style="color: rgb(52, 120, 229); font-weight: 700; font-style: normal; font-size: 16px;">Orbit People</a>
         <p data-template-id="job7-meta" class="canva-text job-meta" style="color: rgb(92, 120, 148); font-weight: 600; font-style: normal; font-size: 16px;">Surabaya · Full-Time · 1 minggu lalu</p>
         <p data-template-id="job7-description" class="canva-text job-description" style="color: rgb(84, 112, 141); font-weight: 400; font-style: normal; font-size: 16px;">Bangun pengalaman kandidat dan karyawan yang bertumbuh bersama.</p><a data-template-id="job7-apply" class="canva-button apply-button" href="/lowongan/detail/hr-specialist" style="background: rgb(21, 58, 104); color: rgb(255, 255, 255); font-weight: 800; font-style: normal; font-size: 16px;">Lamar</a>
        </article>
        <article class="job-card" data-company="Nusantara Labs" data-location="Jakarta" data-type="Magang" data-search="social media strategist nusantara labs jakarta magang konten kampanye digital">
         <div class="job-card-head">
          <span data-template-id="job8-badge" class="canva-tag job-badge" style="background: rgb(224, 246, 232); color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Media Sosial</span><span class="job-symbol">✦</span>
         </div><a data-template-id="job8-title" class="canva-link job-title-link" href="/lowongan/detail/social-media-strategist" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 21px;">Social Media Strategist</a> <a data-template-id="job8-company" class="canva-link company-link" href="/lowongan/detail/social-media-strategist" style="color: rgb(52, 120, 229); font-weight: 700; font-style: normal; font-size: 16px;">Nusantara Labs</a>
         <p data-template-id="job8-meta" class="canva-text job-meta" style="color: rgb(92, 120, 148); font-weight: 600; font-style: normal; font-size: 16px;">Jakarta · Magang · 1 hari lalu</p>
         <p data-template-id="job8-description" class="canva-text job-description" style="color: rgb(84, 112, 141); font-weight: 400; font-style: normal; font-size: 16px;">Kembangkan strategi sosial yang relevan, ceria, dan berbasis komunitas.</p><a data-template-id="job8-apply" class="canva-button apply-button" href="/lowongan/detail/social-media-strategist" style="background: rgb(21, 58, 104); color: rgb(255, 255, 255); font-weight: 800; font-style: normal; font-size: 16px;">Lamar</a>
        </article>
       </div>
       <section id="empty-state" class="empty-state" aria-live="polite">
        <div class="empty-icon">
         ⌕
        </div>
        <h3 data-template-id="empty-title" class="canva-text" style="color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 21px;">Belum ada lowongan yang cocok</h3>
        <p data-template-id="empty-description" class="canva-text" style="color: rgb(84, 112, 141); font-weight: 400; font-style: normal; font-size: 16px;">Coba gunakan kata kunci lain atau atur ulang filter untuk melihat semua peluang.</p><button data-template-id="empty-reset-button" id="empty-reset" class="canva-button apply-button" type="button" style="background: rgb(52, 120, 229); color: rgb(255, 255, 255); font-weight: 800; font-style: normal; font-size: 16px;">Reset Filter</button>
       </section>
       <section data-template-id="ticket-banner" class="canva-banner ticket-banner" style="background: rgb(52, 120, 229);"><span class="ticket-divider" aria-hidden="true"></span>
        <div class="ticket-content">
         <div class="ticket-copy">
          <p data-template-id="ticket-kicker" class="canva-text section-kicker" style="color: rgb(255, 216, 74); font-weight: 800; font-style: normal; font-size: 16px;">PANGGILAN KOMUNITAS</p>
          <h2 data-template-id="ticket-title" class="canva-text ticket-title" style="color: rgb(255, 255, 255); font-weight: 700; font-style: normal; font-size: 24px;">Bagikan peluang untuk sesama alumni</h2>
          <p data-template-id="ticket-description" class="canva-text ticket-description" style="color: rgb(255, 255, 255); font-weight: 400; font-style: normal; font-size: 16px; line-height: 1.5;">Kenalkan posisi terbuka di perusahaanmu dan bantu alumni lain menemukan langkah berikutnya.</p>
         </div><a data-template-id="post-job-button" class="canva-button ticket-cta" href="/lowongan" style="background: rgb(255, 216, 74); color: rgb(21, 58, 104); font-weight: 800; font-style: normal; font-size: 16px;">Lihat Lowongan</a>
        </div>
       </section>
      </div>
     </div>
    </section>
   </main>
   <footer data-template-id="footer-section" class="canva-footer site-footer" style="background: rgb(255, 255, 255);">
    <div class="page-width footer-inner">
     <p data-template-id="footer-copy" class="canva-text" style="color: rgb(21, 58, 104); font-weight: 600; font-style: normal; font-size: 16px;">© 2026 Alumni Space · Tumbuh bersama setelah kelulusan.</p>
     <p data-template-id="footer-note" class="canva-text" style="color: rgb(99, 128, 157); font-weight: 400; font-style: normal; font-size: 16px;">Untuk alumni, oleh alumni.</p>
    </div>
   </footer>
  </div>
  <script src="/_sdk/e0cded0d68b23178.editing_sdk.js" integrity="sha512-bFeXIjbg22mYUe3GIRhzGfTmnWXDQ1gpzjxFFeOafZ3Hgoa5umstmjq59/GhbUuG8kwzhx1ZV3fIvsbqgqljcw=="></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var menuToggle = document.getElementById("menu-toggle");
      var mobileNav = document.getElementById("mobile-nav");
      var backButton = document.getElementById("back-button");
      var searchInput = document.getElementById("search-input");
      var companyFilter = document.getElementById("company-filter");
      var locationFilter = document.getElementById("location-filter");
      var resetButton = document.getElementById("reset-filter");
      var emptyResetButton = document.getElementById("empty-reset");
      var cards = Array.prototype.slice.call(document.querySelectorAll(".job-card"));
      var chips = Array.prototype.slice.call(document.querySelectorAll(".filter-chip"));
      var emptyState = document.getElementById("empty-state");
      var resultCount = document.getElementById("results-count");
      var filterSummary = document.getElementById("filter-summary");
      var activeType = "";

      function filterJobs() {
        var query = searchInput.value.trim().toLowerCase();
        var company = companyFilter.value;
        var location = locationFilter.value;
        var count = 0;

        cards.forEach(function (card) {
          var matchesQuery = !query || card.dataset.search.indexOf(query) !== -1;
          var matchesCompany = !company || card.dataset.company === company;
          var matchesLocation = !location || card.dataset.location === location;
          var matchesType = !activeType || card.dataset.type === activeType;
          var matches = matchesQuery && matchesCompany && matchesLocation && matchesType;

          card.classList.toggle("is-hidden", !matches);

          if (matches) {
            count += 1;
          }
        });

        var filters = [];
        if (query) filters.push('"' + searchInput.value.trim() + '"');
        if (company) filters.push(company);
        if (location) filters.push(location);
        if (activeType) filters.push(activeType);

        resultCount.textContent = "Menampilkan " + count + " lowongan";
        filterSummary.textContent = filters.length ? "Filter: " + filters.join(" · ") : "Semua peluang aktif";
        emptyState.classList.toggle("is-visible", count === 0);
      }

      function resetFilters() {
        searchInput.value = "";
        companyFilter.value = "";
        locationFilter.value = "";
        activeType = "";

        chips.forEach(function (chip) {
          chip.classList.remove("is-active");
          chip.setAttribute("aria-pressed", "false");
        });

        filterJobs();
      }

      menuToggle.addEventListener("click", function () {
        var isOpen = mobileNav.classList.toggle("is-open");
        menuToggle.setAttribute("aria-expanded", String(isOpen));
      });

      mobileNav.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function () {
          mobileNav.classList.remove("is-open");
          menuToggle.setAttribute("aria-expanded", "false");
        });
      });

      backButton.addEventListener("click", function () {
        if (window.history.length > 1) {
          window.history.back();
          return;
        }

        window.open("/lowongan", "_self");
      });

      searchInput.addEventListener("input", filterJobs);
      companyFilter.addEventListener("change", filterJobs);
      locationFilter.addEventListener("change", filterJobs);

      chips.forEach(function (chip) {
        chip.setAttribute("aria-pressed", "false");

        chip.addEventListener("click", function () {
          activeType = activeType === chip.dataset.type ? "" : chip.dataset.type;

          chips.forEach(function (item) {
            var isActive = item.dataset.type === activeType;
            item.classList.toggle("is-active", isActive);
            item.setAttribute("aria-pressed", String(isActive));
          });

          filterJobs();
        });
      });

      resetButton.addEventListener("click", resetFilters);
      emptyResetButton.addEventListener("click", resetFilters);

      lucide.createIcons();
      filterJobs();
    });
  </script>
 
</body></html>