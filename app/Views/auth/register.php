<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Daftar Akun — Pratama Lempok Durian') ?></title>

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
<body class="bg-[#fafaf9] text-zinc-900 min-h-screen flex items-center justify-center p-4 py-12">

    <div class="max-w-md w-full space-y-6">
        
        <div class="text-center space-y-2">
            <a href="/" class="inline-flex items-center gap-2 group">
                <div class="w-12 h-12 rounded-2xl bg-primary text-white flex items-center justify-center font-black text-2xl shadow-md group-hover:scale-105 transition">
                    P
                </div>
            </a>
            <h2 class="text-2xl font-black text-zinc-900 tracking-tight">Daftar Akun Pelanggan</h2>
            <p class="text-xs text-zinc-500">Nikmati kemudahan eksplorasi dan pemesanan Lempok Durian</p>
        </div>

        <?php $errors = session()->getFlashdata('errors') ?? []; ?>

        <div class="bg-white border border-zinc-200 rounded-3xl p-6 sm:p-8 shadow-sm">
            <form action="<?= base_url('/register') ?>" method="POST" class="space-y-4">
                <?= csrf_field() ?>

                <!-- Nama Lengkap -->
                <div>
                    <label for="nama" class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Nama Lengkap *</label>
                    <div class="relative">
                        <i data-lucide="user" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-400"></i>
                        <input type="text" 
                               name="nama" 
                               id="nama" 
                               value="<?= old('nama') ?>" 
                               required 
                               placeholder="Contoh: Fabian Rizky Pratama"
                               class="w-full bg-zinc-50 border <?= isset($errors['nama']) ? 'border-red-500 focus:ring-red-500' : 'border-zinc-200 focus:ring-primary' ?> rounded-xl pl-10 pr-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:bg-white transition">
                    </div>
                    <?php if (isset($errors['nama'])): ?>
                        <p class="text-[11px] text-red-500 mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> <?= esc($errors['nama']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Username *</label>
                    <div class="relative">
                        <i data-lucide="at-sign" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-400"></i>
                        <input type="text" 
                               name="username" 
                               id="username" 
                               value="<?= old('username') ?>" 
                               required 
                               placeholder="huruf & angka tanpa spasi"
                               class="w-full bg-zinc-50 border <?= isset($errors['username']) ? 'border-red-500 focus:ring-red-500' : 'border-zinc-200 focus:ring-primary' ?> rounded-xl pl-10 pr-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:bg-white transition">
                    </div>
                    <?php if (isset($errors['username'])): ?>
                        <p class="text-[11px] text-red-500 mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> <?= esc($errors['username']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Alamat Email *</label>
                    <div class="relative">
                        <i data-lucide="mail" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-400"></i>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="<?= old('email') ?>" 
                               required 
                               placeholder="nama@email.com"
                               class="w-full bg-zinc-50 border <?= isset($errors['email']) ? 'border-red-500 focus:ring-red-500' : 'border-zinc-200 focus:ring-primary' ?> rounded-xl pl-10 pr-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:bg-white transition">
                    </div>
                    <?php if (isset($errors['email'])): ?>
                        <p class="text-[11px] text-red-500 mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> <?= esc($errors['email']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Kata Sandi *</label>
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

                <!-- Konfirmasi Password -->
                <div>
                    <label for="konfirmasi_password" class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Konfirmasi Kata Sandi *</label>
                    <div class="relative">
                        <i data-lucide="shield-check" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-400"></i>
                        <input type="password" 
                               name="konfirmasi_password" 
                               id="konfirmasi_password" 
                               required 
                               placeholder="Ulangi kata sandi"
                               class="w-full bg-zinc-50 border <?= isset($errors['konfirmasi_password']) ? 'border-red-500 focus:ring-red-500' : 'border-zinc-200 focus:ring-primary' ?> rounded-xl pl-10 pr-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:bg-white transition">
                    </div>
                    <?php if (isset($errors['konfirmasi_password'])): ?>
                        <p class="text-[11px] text-red-500 mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> <?= esc($errors['konfirmasi_password']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-indigo-900 text-white font-bold py-3 px-4 rounded-xl text-xs transition shadow-md flex items-center justify-center gap-2">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    <span>Daftar Sekarang</span>
                </button>
            </form>

            <div class="mt-4 pt-4 border-t border-zinc-100 text-center text-xs text-zinc-500">
                Sudah memiliki akun? 
                <a href="<?= base_url('/login') ?>" class="font-bold text-primary hover:underline">Masuk di sini</a>
            </div>
        </div>

        <div class="text-center">
            <a href="/" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-500 hover:text-primary transition">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali ke Beranda</span>
            </a>
        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
