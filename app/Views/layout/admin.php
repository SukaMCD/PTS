<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard Admin — Pratama Lempok Durian') ?></title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3730A3',
                        accent: '#FDBA74',
                    }
                }
            }
        }
    </script>
    <!-- Lucide Icons & SweetAlert2 CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#f8f8f6] text-zinc-900 antialiased flex min-h-screen">

    <!-- Sidebar Admin -->
    <aside class="w-64 bg-white border-r border-zinc-200 p-6 flex flex-col justify-between hidden md:flex shrink-0">
        <div class="space-y-6">
            <!-- Brand -->
            <a href="/" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-primary text-white flex items-center justify-center font-black text-lg shadow-sm">
                    P
                </div>
                <div>
                    <span class="font-extrabold text-sm text-primary tracking-tight block">PRATAMA</span>
                    <span class="text-[10px] text-zinc-400 font-semibold uppercase tracking-wider">Panel Pengelola</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <div class="space-y-1">
                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest px-3 block mb-2">Manajemen Menu</span>
                <a href="/admin/makanan" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold bg-primary text-white shadow-sm transition">
                    <i data-lucide="utensils" class="w-4 h-4"></i>
                    <span>Katalog Makanan (CRUD)</span>
                </a>
                <a href="/admin/makanan/create" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 transition">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    <span>Tambah Menu Baru</span>
                </a>
            </div>

            <div class="space-y-1">
                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest px-3 block mb-2">Navigasi Publik</span>
                <a href="/" target="_blank" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 transition">
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    <span>Lihat Halaman Depan</span>
                </a>
            </div>
        </div>

        <!-- User Profile Card -->
        <div class="pt-4 border-t border-zinc-200 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-primary/10 text-primary font-bold text-xs flex items-center justify-center uppercase">
                    <?= substr(session()->get('nama') ?? 'U', 0, 1) ?>
                </div>
                <div class="text-left">
                    <span class="font-bold text-xs text-zinc-800 block truncate max-w-[100px]"><?= esc(session()->get('nama')) ?></span>
                    <span class="text-[10px] font-semibold text-primary uppercase"><?= esc(session()->get('role')) ?></span>
                </div>
            </div>
            <a href="/logout" onclick="return confirm('Keluar dari sesi admin?')" class="p-2 text-zinc-400 hover:text-red-600 transition" title="Logout">
                <i data-lucide="log-out" class="w-4 h-4"></i>
            </a>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- Top Navbar -->
        <header class="h-16 bg-white border-b border-zinc-200 px-6 flex items-center justify-between">
            <div class="flex items-center gap-2 text-xs text-zinc-500 font-medium">
                <i data-lucide="calendar" class="w-3.5 h-3.5 text-primary"></i>
                <span><?= date('l, d F Y') ?></span>
                <span class="text-zinc-300">•</span>
                <span class="text-emerald-600 font-bold">Outlet Bengkulu Aktif</span>
            </div>

            <div class="flex items-center gap-3">
                <a href="/" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-zinc-100 text-zinc-700 hover:bg-zinc-200 transition">
                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                    <span>Halaman Publik</span>
                </a>
            </div>
        </header>

        <!-- Main Workspace Content -->
        <main class="flex-1 p-6 md:p-8 overflow-y-auto">
            
            <!-- Toast Feedback -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2 shadow-sm">
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                    <span><?= esc(session()->getFlashdata('success')) ?></span>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs font-semibold flex items-center gap-2 shadow-sm">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-red-600 shrink-0"></i>
                    <span><?= esc(session()->getFlashdata('error')) ?></span>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <!-- Init Lucide -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
