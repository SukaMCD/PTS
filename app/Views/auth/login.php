<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Login Pengelola — Pratama Lempok Durian') ?></title>

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
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#fafaf9] text-zinc-900 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full space-y-6">
        
        <!-- Header Brand -->
        <div class="text-center space-y-2">
            <a href="/" class="inline-flex items-center gap-2 group">
                <div class="w-12 h-12 rounded-2xl bg-primary text-white flex items-center justify-center font-black text-2xl shadow-md group-hover:scale-105 transition">
                    P
                </div>
            </a>
            <h2 class="text-2xl font-black text-zinc-900 tracking-tight">Portal Pengelola Restoran</h2>
            <p class="text-xs text-zinc-500">Pratama Lempok Durian Khas Bengkulu</p>
        </div>

        <!-- Alert Notification -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs flex items-center gap-2 shadow-sm">
                <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                <span><?= esc(session()->getFlashdata('error')) ?></span>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs flex items-center gap-2 shadow-sm">
                <i data-lucide="check-circle" class="w-4 h-4 shrink-0"></i>
                <span><?= esc(session()->getFlashdata('success')) ?></span>
            </div>
        <?php endif; ?>

        <!-- Form Card -->
        <div class="bg-white border border-zinc-200 rounded-3xl p-6 sm:p-8 shadow-sm">
            <form action="<?= base_url('/login') ?>" method="POST" class="space-y-4">
                <?= csrf_field() ?>

                <?php $errors = session()->getFlashdata('errors') ?? []; ?>

                <div>
                    <label for="username" class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Username / Email</label>
                    <div class="relative">
                        <i data-lucide="user" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-400"></i>
                        <input type="text" 
                               name="username" 
                               id="username" 
                               value="<?= old('username') ?>" 
                               required 
                               placeholder="admin atau petugas@domain.com"
                               class="w-full bg-zinc-50 border <?= isset($errors['username']) ? 'border-red-500 focus:ring-red-500' : 'border-zinc-200 focus:ring-primary' ?> rounded-xl pl-10 pr-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:bg-white transition">
                    </div>
                    <?php if (isset($errors['username'])): ?>
                        <p class="text-[11px] text-red-500 mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> <?= esc($errors['username']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Kata Sandi</label>
                    <div class="relative">
                        <i data-lucide="lock" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-400"></i>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               required 
                               placeholder="Minimal 6 karakter"
                               class="w-full bg-zinc-50 border <?= isset($errors['password']) ? 'border-red-500 focus:ring-red-500' : 'border-zinc-200 focus:ring-primary' ?> rounded-xl pl-10 pr-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:bg-white transition">
                    </div>
                    <?php if (isset($errors['password'])): ?>
                        <p class="text-[11px] text-red-500 mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> <?= esc($errors['password']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-indigo-900 text-white font-bold py-3 px-4 rounded-xl text-xs transition shadow-md flex items-center justify-center gap-2">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    <span>Masuk ke Dashboard</span>
                </button>
            </form>

            <div class="mt-4 pt-4 border-t border-zinc-100 text-center text-xs text-zinc-500">
                Belum punya akun pelanggan? 
                <a href="<?= base_url('/register') ?>" class="font-bold text-primary hover:underline">Daftar di sini</a>
            </div>
        </div>

        <!-- Testing Credentials Helper Box (Untuk Penguji / Guru) -->
        <div class="bg-primary/5 border border-primary/20 rounded-2xl p-4 text-xs space-y-2">
            <span class="font-bold text-primary flex items-center gap-1.5 uppercase text-[11px] tracking-wider">
                <i data-lucide="info" class="w-3.5 h-3.5"></i> Akun Pengujian Ujian (Default Seeder):
            </span>
            <div class="grid grid-cols-2 gap-2 text-[11px] text-zinc-600">
                <div class="bg-white p-2 rounded-lg border border-zinc-200">
                    <span class="font-bold text-zinc-800 block">Admin (Full Access)</span>
                    <span>user: <code>admin</code></span><br>
                    <span>pass: <code>admin123</code></span>
                </div>
                <div class="bg-white p-2 rounded-lg border border-zinc-200">
                    <span class="font-bold text-zinc-800 block">Petugas Outlet</span>
                    <span>user: <code>petugas</code></span><br>
                    <span>pass: <code>petugas123</code></span>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="/" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-500 hover:text-primary transition">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali ke Halaman Beranda</span>
            </a>
        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
