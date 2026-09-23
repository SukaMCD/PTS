<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Pratama Lempok Durian — Kuliner Khas Bengkulu') ?></title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#3730A3',
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730A3',
                            900: '#312e81',
                        },
                        accent: {
                            DEFAULT: '#FDBA74',
                            50: '#fff7ed',
                            100: '#ffedd5',
                            400: '#fb923c',
                            500: '#FDBA74',
                            600: '#ea580c',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Lucide Icons & Alpine.js CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#fafaf9] text-zinc-900 antialiased flex flex-col min-h-screen">

    <!-- Top Announcement Bar -->
    <div class="bg-primary-900 text-white text-xs py-2 px-4 text-center font-medium flex items-center justify-center gap-2">
        <span class="inline-block w-2 h-2 rounded-full bg-accent animate-pulse"></span>
        <span>Kuliner Asli Bumi Rafflesia Bengkulu — 100% Daging Durian Asli Tanpa Campuran Tepung</span>
        <span class="hidden md:inline font-bold text-accent ml-2">Promo Diskon Oleh-Oleh Tersedia!</span>
    </div>

    <!-- Navigation Header -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-zinc-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Logo & Brand -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-xl bg-primary text-white flex items-center justify-center font-black text-xl shadow-md group-hover:scale-105 transition">
                    P
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-extrabold text-xl tracking-tight text-primary">PRATAMA</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-accent/20 text-amber-900 border border-accent/40 uppercase">Bengkulu</span>
                    </div>
                    <p class="text-[11px] font-medium text-zinc-500 tracking-wide uppercase">Authentic Lempok Durian</p>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-zinc-600">
                <a href="/#menu" class="hover:text-primary transition">Katalog Menu</a>
                <a href="/#tentang" class="hover:text-primary transition">Tentang Lempok</a>
                <a href="/#keunggulan" class="hover:text-primary transition">Keunggulan</a>
                <a href="/#testimoni" class="hover:text-primary transition">Ulasan</a>
            </nav>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3">
                <?php if (session()->get('is_logged_in')): ?>
                    <a href="/admin/makanan" class="inline-flex items-center gap-2 bg-primary text-white hover:bg-primary-900 px-4 py-2.5 rounded-xl text-xs font-bold transition shadow-sm">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        <span>Panel Kelola (<?= esc(session()->get('role')) ?>)</span>
                    </a>
                    <a href="/logout" class="p-2 text-zinc-400 hover:text-red-600 transition" title="Logout">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </a>
                <?php else: ?>
                    <a href="/login" class="inline-flex items-center gap-2 bg-primary text-white hover:bg-primary-700 px-4 py-2.5 rounded-xl text-xs font-bold transition shadow-sm">
                        <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                        <span>Login Pengelola</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-950 text-zinc-400 text-sm mt-20 border-t border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 grid grid-cols-1 md:grid-cols-4 gap-10">
            <div class="md:col-span-2 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center font-black text-lg">
                        P
                    </div>
                    <span class="font-extrabold text-xl text-white tracking-tight">PRATAMA <span class="text-accent font-normal">LEMPOK DURIAN</span></span>
                </div>
                <p class="text-zinc-400 text-xs leading-relaxed max-w-md">
                    Mengangkat kuliner warisan leluhur Bengkulu ke panggung kuliner modern. Dibuat murni dari daging durian pilihan tanpa bahan pengawet kimia dan tanpa tepung, dimasak dalam kuali tembaga tradisional.
                </p>
                <div class="flex items-center gap-3 text-xs text-zinc-500 pt-2">
                    <span class="flex items-center gap-1.5"><i data-lucide="map-pin" class="w-3.5 h-3.5 text-accent"></i> Jl. Soeprapto No. 45, Kota Bengkulu</span>
                </div>
            </div>

            <div>
                <h4 class="font-bold text-white text-xs uppercase tracking-wider mb-4">Navigasi Cepat</h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="/#menu" class="hover:text-white transition">Semua Menu Makanan</a></li>
                    <li><a href="/#tentang" class="hover:text-white transition">Kisah Lempok Bengkulu</a></li>
                    <li><a href="/#keunggulan" class="hover:text-white transition">Standar Kualitas</a></li>
                    <li><a href="/login" class="hover:text-accent transition">Portal Admin & Petugas</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-white text-xs uppercase tracking-wider mb-4">Informasi Operasional</h4>
                <div class="space-y-2 text-xs">
                    <p class="flex items-center gap-2"><i data-lucide="clock" class="w-3.5 h-3.5 text-accent"></i> Buka Setiap Hari: 08.00 - 21.00 WIB</p>
                    <p class="flex items-center gap-2"><i data-lucide="phone" class="w-3.5 h-3.5 text-accent"></i> Pesanan / WhatsApp: 0812-7890-1234</p>
                    <p class="flex items-center gap-2"><i data-lucide="shield-check" class="w-3.5 h-3.5 text-accent"></i> Sertifikasi Halal & Dinkes P-IRT</p>
                </div>
            </div>
        </div>

        <div class="border-t border-zinc-900 py-6 text-center text-xs text-zinc-600">
            <p>&copy; <?= date('Y') ?> Pratama Lempok Durian Bengkulu. Dibuat oleh <strong>Fabian Rizky Pratama</strong> — Ujian Praktik Pemrograman Framework.</p>
        </div>
    </footer>

    <!-- Init Lucide -->
    <script>
        lucide.createIcons();
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
