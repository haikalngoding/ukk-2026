<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'GoPENA'))</title>

    <script>
        (function () {
            var saved = localStorage.getItem('sakuci-theme');
            var theme = saved || (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-bs-theme', theme);

            var sidebarState = localStorage.getItem('sidebarState');
            if (sidebarState === null || sidebarState === 'collapsed') {
                document.documentElement.classList.add('preload-collapsed');
            }
        })();
    </script>

    <!-- Menggunakan Font Poppins agar tampilan lebih Modern & Elegan -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- PUSAT CSS KUSTOM -->
    <style>
        /* Terapkan Font ke Seluruh Halaman */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bs-tertiary-bg);
        }

        .app-sidebar {
            width: 260px;
            min-width: 260px;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 1040;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 2px 0 15px rgba(0,0,0,0.03);
            overflow-y: auto;
        }

        /* Custom Scrollbar Tipis & Estetik */
        .app-sidebar::-webkit-scrollbar { width: 4px; }
        .app-sidebar::-webkit-scrollbar-track { background: transparent; }
        .app-sidebar::-webkit-scrollbar-thumb { background: rgba(150, 150, 150, 0.2); border-radius: 10px; }

        .main-wrapper {
            flex-grow: 1;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-width: 0;
        }

        /* Efek Kaca (Glassmorphism) untuk Navbar Atas */
        .glass-header {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05) !important;
        }
        [data-bs-theme="dark"] .glass-header {
            background: rgba(33, 37, 41, 0.85) !important;
            border-bottom: 1px solid rgba(255,255,255,0.05) !important;
        }

        /* Saat sidebar ditutup (collapsed) */
        body.sidebar-collapsed .app-sidebar,
        html.preload-collapsed body .app-sidebar {
            margin-left: -260px;
        }

        /* Desain Link Menu Sidebar */
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-radius: 8px;
            padding: 0.6rem 0.85rem;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            color: var(--bs-body-color);
            opacity: 0.75;
            transition: all 0.2s ease;
        }
        .sidebar-link i {
            font-size: 1.15rem;
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }
        .sidebar-link:hover {
            opacity: 1;
            background-color: rgba(13, 110, 253, 0.08);
            color: var(--bs-primary);
        }
        .sidebar-link:hover i {
            transform: scale(1.1);
        }

        /* Status Aktif */
        .sidebar-link.active {
            opacity: 1 !important;
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
            color: #ffffff !important;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.25);
        }
        .sidebar-link.active i { color: #ffffff !important; }

        .sidebar-heading {
            font-size: 0.65rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 700;
            margin-top: 0.8rem;
            margin-bottom: 0.3rem;
        }
    </style>
</head>
<body>

    <div class="d-flex min-vh-100">

        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Konten Utama --}}
        <div class="main-wrapper d-flex flex-column">
            
            <!-- Navbar Atas (Glassmorphism & Action Bar) -->
            <header class="navbar glass-header px-4 py-3 sticky-top d-flex justify-content-between align-items-center z-3">
                
                <!-- Kiri: Tombol Menu & Judul -->
                <div class="d-flex align-items-center gap-3">
                    <button id="sidebarToggle" class="btn btn-primary shadow-sm d-flex align-items-center gap-2 px-3 py-2 rounded-3 border-0" type="button" aria-label="Toggle Sidebar">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    <div class="d-none d-md-block">
                        <h6 class="mb-0 fw-bold text-body">GoPENA Workspace</h6>
                        <small class="text-body-secondary" style="font-size: 0.75rem;">Sistem Peminjaman Alat Sekolah</small>
                    </div>
                </div>
            </header>

            <main class="container-fluid flex-grow-1 p-4 p-lg-5">
                @include('partials.flash')
                
                <!-- Ini Tempat Konten Halaman Nanti -->
                @yield('content')
                
            </main>

            @include('partials.footer')
            
        </div>
    </div>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/theme.js') }}"></script>

<!-- Skrip Logika Sidebar & Jam Realtime -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Logika Toggle Sidebar
        const toggleBtn = document.getElementById('sidebarToggle');
        const closeBtn = document.getElementById('sidebarToggleClose');
        const body = document.body;

        if (!localStorage.getItem('sidebarState')) {
            localStorage.setItem('sidebarState', 'expanded'); // Diubah default terbuka untuk desktop
        }

        if (localStorage.getItem('sidebarState') === 'collapsed') {
            body.classList.add('sidebar-collapsed');
        }

        function toggleSidebar() {
            body.classList.toggle('sidebar-collapsed');
            document.documentElement.classList.remove('preload-collapsed');
            
            if (body.classList.contains('sidebar-collapsed')) {
                localStorage.setItem('sidebarState', 'collapsed');
            } else {
                localStorage.setItem('sidebarState', 'expanded');
            }
        }

        if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
        if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);

        // Skrip Jam Realtime
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            const clockElement = document.getElementById('realtimeClock');
            if (clockElement) clockElement.textContent = timeString;
        }
        setInterval(updateClock, 1000);
        updateClock();
    });
</script>

@yield('scripts')

</body>
</html>