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

            <!-- Navigation Links Berdasarkan Role -->
            <?php $userRole = session()->get('role') ?? 'admin'; ?>

            <?php if ($userRole === 'admin'): ?>
                <!-- Menu Khusus Admin -->
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest px-3 block mb-2">Master Data</span>
                    <a href="/admin/makanan" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold <?= (uri_string() === 'admin/makanan') ? 'bg-primary text-white shadow-sm' : 'text-zinc-600 hover:bg-zinc-100' ?> transition">
                        <i data-lucide="utensils" class="w-4 h-4"></i>
                        <span>Katalog Menu (CRUD)</span>
                    </a>
                    <a href="/admin/makanan/create" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold <?= (uri_string() === 'admin/makanan/create') ? 'bg-primary text-white shadow-sm' : 'text-zinc-600 hover:bg-zinc-100' ?> transition">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                        <span>Tambah Menu Baru</span>
                    </a>
                </div>

                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest px-3 block mb-2">Administrasi</span>
                    <a href="/admin/users" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold <?= (uri_string() === 'admin/users') ? 'bg-primary text-white shadow-sm' : 'text-zinc-600 hover:bg-zinc-100' ?> transition">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        <span>Manajemen Pengguna</span>
                    </a>
                    <a href="/admin/laporan" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold <?= (uri_string() === 'admin/laporan') ? 'bg-primary text-white shadow-sm' : 'text-zinc-600 hover:bg-zinc-100' ?> transition">
                        <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                        <span>Rekapitulasi Penjualan</span>
                    </a>
                    <a href="/petugas/pesanan" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold <?= (uri_string() === 'petugas/pesanan') ? 'bg-primary text-white shadow-sm' : 'text-zinc-600 hover:bg-zinc-100' ?> transition">
                        <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                        <span>Pantau Antrean Kasir</span>
                    </a>
                </div>
            <?php else: ?>
                <!-- Menu Khusus Petugas / Kasir -->
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest px-3 block mb-2">Operasional Outlet</span>
                    <a href="/petugas/pesanan" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold <?= (strpos(uri_string(), 'petugas/pesanan') !== false) ? 'bg-primary text-white shadow-sm' : 'text-zinc-600 hover:bg-zinc-100' ?> transition">
                        <i data-lucide="inbox" class="w-4 h-4"></i>
                        <span>Antrean Pesanan Kasir</span>
                    </a>
                    <a href="/petugas/stok" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold <?= (uri_string() === 'petugas/stok') ? 'bg-primary text-white shadow-sm' : 'text-zinc-600 hover:bg-zinc-100' ?> transition">
                        <i data-lucide="boxes" class="w-4 h-4"></i>
                        <span>Monitoring Stok Menu</span>
                    </a>
                </div>
            <?php endif; ?>

            <div class="space-y-1 pt-2 border-t border-zinc-100">
                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest px-3 block mb-2">Akses Cepat</span>
                <a href="/" target="_blank" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 transition">
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    <span>Halaman Depan Restoran</span>
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

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs font-semibold space-y-1 shadow-sm">
                    <div class="flex items-center gap-2 font-bold text-red-700">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-red-600 shrink-0"></i>
                        <span>Mohon periksa kesalahan input berikut:</span>
                    </div>
                    <ul class="list-disc list-inside pl-6 text-[11px] text-red-600 space-y-0.5 font-normal">
                        <?php foreach (session()->getFlashdata('errors') as $err): ?>
                            <li><?= esc($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
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
