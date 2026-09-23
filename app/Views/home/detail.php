<?= $this->extend('layout/public') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb -->
<div class="bg-white border-b border-zinc-200 py-3.5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-xs text-zinc-500">
            <a href="/" class="hover:text-primary transition flex items-center gap-1">
                <i data-lucide="home" class="w-3.5 h-3.5"></i>
                <span>Beranda</span>
            </a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-zinc-300"></i>
            <a href="/#menu" class="hover:text-primary transition">Katalog Menu</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-zinc-300"></i>
            <span class="text-zinc-800 font-semibold truncate max-w-xs"><?= esc($makanan['nama_makanan']) ?></span>
        </div>
    </div>
</div>

<!-- Main Detail Product Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left Column: Product Image Gallery -->
            <div class="lg:col-span-6 space-y-4">
                <div class="relative bg-zinc-50 border border-zinc-200 rounded-3xl overflow-hidden shadow-sm">
                    <img src="<?= esc($makanan['gambar'] ?? 'https://images.unsplash.com/photo-1587132137056-bfbf0166836e?w=800&auto=format&fit=crop&q=80') ?>" 
                         alt="<?= esc($makanan['nama_makanan']) ?>" 
                         class="w-full h-96 object-cover">
                    
                    <span class="absolute top-4 left-4 px-3.5 py-1.5 rounded-full text-xs font-bold bg-white/95 backdrop-blur-md text-primary shadow-sm border border-zinc-200">
                        <?= esc($makanan['nama_kategori'] ?? 'Lempok Durian Bengkulu') ?>
                    </span>

                    <span class="absolute top-4 right-4 px-3 py-1.5 rounded-full text-xs font-bold bg-zinc-950/85 backdrop-blur-md text-amber-300 flex items-center gap-1 shadow-sm">
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-300"></i>
                        <span><?= number_format($makanan['rating'], 1) ?> / 5.0</span>
                    </span>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div class="p-3.5 rounded-2xl bg-zinc-50 border border-zinc-200 text-center">
                        <span class="block text-[11px] font-bold text-zinc-400 uppercase">Asal Daerah</span>
                        <span class="text-xs font-bold text-zinc-800 mt-0.5 block"><?= esc($makanan['asal_daerah']) ?></span>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-zinc-50 border border-zinc-200 text-center">
                        <span class="block text-[11px] font-bold text-zinc-400 uppercase">Ketersediaan</span>
                        <span class="text-xs font-bold text-emerald-600 mt-0.5 block"><?= esc($makanan['stok']) ?> Unit Siap Kirim</span>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-zinc-50 border border-zinc-200 text-center">
                        <span class="block text-[11px] font-bold text-zinc-400 uppercase">Komposisi</span>
                        <span class="text-xs font-bold text-primary mt-0.5 block">100% Durian</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Product Detail & Purchase Simulation -->
            <div class="lg:col-span-6 space-y-6">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-accent/20 text-amber-900 border border-accent/40 text-xs font-bold mb-3">
                        <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i>
                        <span>Otentik Khas Bengkulu — Resep Tradisional</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-zinc-900 tracking-tight">
                        <?= esc($makanan['nama_makanan']) ?>
                    </h1>
                    <p class="text-zinc-500 text-sm mt-2 leading-relaxed">
                        <?= esc($makanan['deskripsi_singkat']) ?>
                    </p>
                </div>

                <!-- Price Box -->
                <div class="p-5 rounded-2xl bg-primary-50 border border-primary-100 flex items-baseline justify-between">
                    <div>
                        <span class="text-xs text-primary-700 font-semibold block uppercase tracking-wider">Harga Resmi Outlet</span>
                        <span class="text-3xl font-black text-primary">
                            Rp <?= number_format($makanan['harga'], 0, ',', '.') ?>
                        </span>
                        <span class="text-xs text-zinc-500 ml-1">/ kemasan higienis</span>
                    </div>
                    <span class="text-xs font-bold text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">
                        Stok Tersedia
                    </span>
                </div>

                <!-- Detailed Description -->
                <div class="space-y-3 pt-2">
                    <h3 class="font-bold text-sm text-zinc-900 uppercase tracking-wider flex items-center gap-2">
                        <i data-lucide="file-text" class="w-4 h-4 text-primary"></i> Deskripsi & Karakter Rasa
                    </h3>
                    <div class="text-xs text-zinc-600 leading-relaxed bg-zinc-50 p-4 rounded-xl border border-zinc-200 space-y-2">
                        <p><?= nl2br(esc($makanan['deskripsi_lengkap'] ?? $makanan['deskripsi_singkat'])) ?></p>
                        <p class="font-semibold text-zinc-700 pt-1">
                            Saran Penyimpanan: Simpan pada suhu ruang sejuk (tahan 3 bulan) atau di lemari pendingin untuk masa simpan hingga 6 bulan.
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="pt-4 border-t border-zinc-200 flex flex-wrap items-center gap-4">
                    <a href="https://wa.me/6281278901234?text=Halo%20Pratama%20Lempok%20Durian,%20saya%20tertarik%20memesan%20<?= urlencode($makanan['nama_makanan']) ?>" 
                       target="_blank" 
                       class="flex-1 inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-6 rounded-xl text-sm transition shadow-md">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>Pesan Cepat via WhatsApp</span>
                    </a>

                    <a href="/#menu" class="inline-flex items-center gap-1.5 bg-zinc-100 hover:bg-zinc-200 text-zinc-700 font-semibold py-3.5 px-5 rounded-xl text-xs transition">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        <span>Kembali ke Menu</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Rekomendasi Menu Lainnya -->
        <?php if (!empty($rekomendasi)): ?>
            <div class="mt-20 pt-12 border-t border-zinc-200">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-primary">Pilihan Favorit Lainnya</span>
                        <h2 class="text-2xl font-black text-zinc-900 mt-1">Menu Rekomendasi Pengunjung</h2>
                    </div>
                    <a href="/#menu" class="text-xs font-bold text-primary hover:underline flex items-center gap-1">
                        <span>Lihat Semua</span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <?php foreach ($rekomendasi as $rek): ?>
                        <a href="<?= base_url('/makanan/' . esc($rek['slug'])) ?>" class="group block bg-zinc-50 hover:bg-white border border-zinc-200 rounded-2xl p-4 transition shadow-sm hover:shadow-md">
                            <img src="<?= esc($rek['gambar']) ?>" alt="<?= esc($rek['nama_makanan']) ?>" class="w-full h-36 object-cover rounded-xl mb-3">
                            <h4 class="font-bold text-sm text-zinc-900 group-hover:text-primary transition truncate"><?= esc($rek['nama_makanan']) ?></h4>
                            <div class="flex items-center justify-between mt-2">
                                <span class="font-extrabold text-xs text-primary">Rp <?= number_format($rek['harga'], 0, ',', '.') ?></span>
                                <span class="text-[11px] text-zinc-500 flex items-center gap-0.5"><i data-lucide="star" class="w-3 h-3 text-amber-400 fill-amber-400"></i> <?= number_format($rek['rating'], 1) ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>

<?= $this->endSection() ?>
