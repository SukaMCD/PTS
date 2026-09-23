<?= $this->extend('layout/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="bg-primary text-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Hero Text Content -->
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-accent">Kuliner Tradisional Bengkulu</span>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mt-2">
                        Lempok Durian Asli Warisan Bumi Rafflesia
                    </h1>
                </div>

                <p class="text-zinc-200 text-sm sm:text-base leading-relaxed max-w-xl">
                    Pratama menyajikan olahan lempok durian khas Bengkulu yang dibuat secara tradisional dari 100% daging durian pilihan tanpa campuran tepung. Menghadirkan rasa manis alami, tekstur kenyal legit, dan aroma durian yang khas.
                </p>

                <!-- Value Highlights -->
                <div class="grid grid-cols-3 gap-6 pt-4 border-t border-white/15 max-w-md">
                    <div>
                        <span class="block text-2xl font-bold text-accent">100%</span>
                        <span class="text-xs text-zinc-300 font-medium">Daging Durian Murni</span>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold text-accent">9+</span>
                        <span class="text-xs text-zinc-300 font-medium">Pilihan Menu</span>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold text-accent">Alami</span>
                        <span class="text-xs text-zinc-300 font-medium">Tanpa Pengawet</span>
                    </div>
                </div>

                <!-- CTA Actions -->
                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <a href="#menu" class="inline-flex items-center gap-2 bg-accent text-zinc-950 font-bold px-6 py-3 rounded-xl hover:bg-amber-300 transition shadow-sm text-xs">
                        <i data-lucide="utensils" class="w-4 h-4"></i>
                        <span>Lihat Katalog Menu</span>
                    </a>
                    <a href="#tentang" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold px-6 py-3 rounded-xl transition text-xs">
                        <span>Tentang Lempok</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <!-- Hero Visual Card -->
            <div class="lg:col-span-5">
                <div class="relative mx-auto max-w-md bg-white/5 border border-white/15 p-3 rounded-3xl shadow-xl">
                    <img src="https://i0.wp.com/resepkoki.id/wp-content/uploads/2022/05/Resep-Lempok-Durian.jpg?fit=450%2C600&ssl=1" 
                         alt="Lempok Durian Bengkulu" 
                         class="w-full h-80 object-cover rounded-2xl">
                    
                    <div class="mt-3 p-3.5 rounded-xl bg-white text-zinc-900 flex items-center justify-between shadow-sm">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-primary">Menu Pilihan</span>
                            <h4 class="font-bold text-xs sm:text-sm text-zinc-900">Lempok Durian Original Bengkulu</h4>
                            <span class="text-xs font-bold text-primary">Rp 45.000 / pack</span>
                        </div>
                        <a href="#menu" class="p-2 rounded-lg bg-primary text-white hover:bg-primary-900 transition">
                            <i data-lucide="arrow-down" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Filter, Pencarian, & Sorting Bar (Fitur 1 & Fitur 2) -->
<section id="menu" class="py-12 bg-white border-b border-zinc-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-primary block mb-1">
                    Katalog Olahan Lempok
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-zinc-900 tracking-tight">Daftar Variasi Menu Pratama</h2>
                <p class="text-zinc-500 text-xs sm:text-sm mt-1">Tersedia <?= count($makanan) ?> pilihan olahan makanan khas Bengkulu siap dipesan</p>
            </div>

            <!-- Form Pencarian & Sorting -->
            <form action="<?= base_url('/#menu') ?>" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
                
                <!-- Input Pencarian (Fitur 1) -->
                <div class="relative min-w-[240px]">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-400"></i>
                    <input type="text" 
                           name="q" 
                           value="<?= esc($keyword ?? '') ?>" 
                           placeholder="Cari menu, rasa, daerah..." 
                           class="w-full bg-zinc-50 border border-zinc-200 rounded-xl pl-10 pr-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                </div>

                <!-- Dropdown Sorting (Fitur 2) -->
                <div class="relative min-w-[180px]">
                    <select name="sort" 
                            onchange="this.form.submit()" 
                            class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-xs font-medium text-zinc-800 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition cursor-pointer">
                        <option value="terbaru"   <?= ($sort === 'terbaru') ? 'selected' : '' ?>>Urutan: Terbaru</option>
                        <option value="termurah"  <?= ($sort === 'termurah') ? 'selected' : '' ?>>Harga: Termurah</option>
                        <option value="termahal"  <?= ($sort === 'termahal') ? 'selected' : '' ?>>Harga: Termahal</option>
                        <option value="rating"    <?= ($sort === 'rating') ? 'selected' : '' ?>>Rating Tertinggi</option>
                        <option value="nama_asc"  <?= ($sort === 'nama_asc') ? 'selected' : '' ?>>Nama: A - Z</option>
                        <option value="nama_desc" <?= ($sort === 'nama_desc') ? 'selected' : '' ?>>Nama: Z - A</option>
                    </select>
                </div>

                <!-- Tombol Submit & Reset -->
                <button type="submit" class="bg-primary hover:bg-primary-900 text-white px-4 py-2.5 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-sm">
                    <i data-lucide="sliders-horizontal" class="w-3.5 h-3.5"></i>
                    <span>Terapkan</span>
                </button>

                <?php if (!empty($keyword) || !empty($kategoriAktif) || $sort !== 'terbaru'): ?>
                    <a href="/#menu" class="p-2.5 bg-zinc-100 hover:bg-zinc-200 text-zinc-600 rounded-xl text-xs flex items-center justify-center" title="Reset Filter">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Category Filter Pills -->
        <div class="flex items-center gap-2 overflow-x-auto pb-4 scrollbar-none text-xs">
            <a href="/#menu" 
               class="px-4 py-2 rounded-xl font-bold whitespace-nowrap transition <?= empty($kategoriAktif) ? 'bg-primary text-white shadow-sm' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200' ?>">
                Semua Kategori (<?= $totalMenu ?>)
            </a>
            <?php foreach ($kategoriList as $kat): ?>
                <a href="<?= base_url('/?kategori=' . $kat['slug'] . '#menu') ?>" 
                   class="px-4 py-2 rounded-xl font-semibold whitespace-nowrap transition <?= ($kategoriAktif === $kat['slug']) ? 'bg-primary text-white shadow-sm' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200' ?>">
                    <?= esc($kat['nama_kategori']) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Grid Menu Makanan (Minimal 8 Menu) -->
        <?php if (empty($makanan)): ?>
            <div class="text-center py-16 bg-zinc-50 rounded-2xl border border-zinc-200 my-6">
                <i data-lucide="package-search" class="w-12 h-12 text-zinc-300 mx-auto mb-3"></i>
                <h4 class="font-bold text-zinc-800 text-sm">Tidak ada menu yang sesuai kriteria</h4>
                <p class="text-zinc-500 text-xs mt-1">Coba gunakan kata kunci pencarian atau filter yang berbeda.</p>
                <a href="/#menu" class="inline-block mt-4 text-xs font-bold text-primary underline">Lihat Semua Menu</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-4">
                <?php foreach ($makanan as $item): ?>
                    <div class="group bg-white border border-zinc-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md hover:border-zinc-300 transition duration-200 flex flex-col">
                        
                        <!-- Gambar Makanan -->
                        <div class="relative h-52 overflow-hidden bg-zinc-100">
                            <?php 
                                $cardImg = $item['gambar'] ?: 'https://images.unsplash.com/photo-1587132137056-bfbf0166836e?w=600&auto=format&fit=crop&q=80';
                                $cardImgUrl = (strpos($cardImg, 'http') === 0) ? $cardImg : base_url($cardImg);
                            ?>
                            <img src="<?= esc($cardImgUrl) ?>" 
                                 alt="<?= esc($item['nama_makanan']) ?>" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            
                            <!-- Kategori Badge -->
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-white/95 backdrop-blur-md text-primary shadow-sm border border-zinc-200/60">
                                <?= esc($item['nama_kategori'] ?? 'Lempok Bengkulu') ?>
                            </span>

                            <!-- Rating Badge -->
                            <span class="absolute top-3 right-3 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-zinc-950/80 text-amber-300 flex items-center gap-1 shadow-sm">
                                <i data-lucide="star" class="w-3 h-3 fill-amber-300"></i>
                                <span><?= number_format($item['rating'], 1) ?></span>
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-1.5 text-zinc-400 text-[11px] font-medium mb-1">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-zinc-400"></i>
                                    <span><?= esc($item['asal_daerah'] ?? 'Bengkulu') ?></span>
                                    <span class="text-zinc-300">•</span>
                                    <span class="text-emerald-700 font-semibold">Stok: <?= esc($item['stok']) ?></span>
                                </div>

                                <h3 class="font-bold text-base text-zinc-900 group-hover:text-primary transition line-clamp-1">
                                    <?= esc($item['nama_makanan']) ?>
                                </h3>

                                <p class="text-zinc-500 text-xs mt-2 line-clamp-2 leading-relaxed">
                                    <?= esc($item['deskripsi_singkat']) ?>
                                </p>
                            </div>

                            <!-- Card Footer: Harga & Tombol Detail -->
                            <div class="pt-4 mt-4 border-t border-zinc-100 flex items-center justify-between">
                                <div>
                                    <span class="text-[10px] text-zinc-400 font-semibold block uppercase">Harga</span>
                                    <span class="font-extrabold text-base text-primary">
                                        Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                                    </span>
                                </div>

                                <a href="<?= base_url('/makanan/' . esc($item['slug'])) ?>" 
                                   class="inline-flex items-center gap-1.5 bg-primary text-white hover:bg-primary-900 px-3.5 py-2 rounded-xl text-xs font-semibold transition">
                                    <span>Detail Menu</span>
                                    <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Section Mengapa Memilih Lempok Durian Pratama Bengkulu -->
<section id="tentang" class="py-16 bg-[#fafaf8] border-b border-zinc-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-wider text-primary block mb-1">
                Karakteristik Kuliner
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-zinc-900 tracking-tight">Kekhasan Lempok Durian Bengkulu</h2>
            <p class="text-zinc-600 text-xs sm:text-sm mt-2">
                Berbeda dari dodol pada umumnya yang menggunakan tepung ketan, lempok durian khas Bengkulu mempertahankan kemurnian olahan dari daging durian asli.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                    <i data-lucide="check" class="w-5 h-5"></i>
                </div>
                <h4 class="font-bold text-base text-zinc-900">100% Daging Durian Asli</h4>
                <p class="text-zinc-500 text-xs leading-relaxed">
                    Hanya menggunakan daging buah durian segar lokal Bengkulu dan gula pasir sebagai pengawet alami, tanpa campuran tepung sedikitpun.
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm space-y-3">
                <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                    <i data-lucide="flame" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-base text-zinc-900">Dimasak Kuali Tembaga 5 Jam</h4>
                <p class="text-zinc-500 text-xs leading-relaxed">
                    Diaduk perlahan menggunakan api konstan dalam kuali tembaga tradisional agar menghasilkan tekstur kenyal kalis yang tidak mudah gosong.
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm space-y-3">
                <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                    <i data-lucide="gift" class="w-6 h-6"></i>
                </div>
                <h4 class="font-bold text-base text-zinc-900">Oleh-Oleh Khas Wajib Bengkulu</h4>
                <p class="text-zinc-500 text-xs leading-relaxed">
                    Dikemas dalam kemasan higienis modern berstandar pangan nasional, cocok sebagai buah tangan eksklusif untuk sanak keluarga tercinta.
                </p>
            </div>
        </div>

    </div>
</section>

<!-- Section Ulasan Pelanggan -->
<section id="testimoni" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-wider text-primary mb-1 block">Ulasan Pelanggan</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-zinc-900 tracking-tight">Pengalaman Menikmati Lempok Pratama</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-5 rounded-2xl border border-zinc-200 bg-zinc-50 flex flex-col justify-between">
                <div>
                    <div class="flex text-amber-400 gap-1 mb-3">
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                    </div>
                    <p class="text-xs text-zinc-600 leading-relaxed">
                        "Teksturnya kenyal dan legit. Rasa duriannya sangat pekat karena murni tanpa campuran tepung ketan. Sangat cocok untuk oleh-oleh khas Bengkulu."
                    </p>
                </div>
                <div class="pt-3 mt-4 border-t border-zinc-200 text-xs font-bold text-zinc-900">
                    Budi Santoso <span class="text-zinc-400 font-normal block text-[11px] mt-0.5">Jakarta</span>
                </div>
            </div>

            <div class="p-5 rounded-2xl border border-zinc-200 bg-zinc-50 flex flex-col justify-between">
                <div>
                    <div class="flex text-amber-400 gap-1 mb-3">
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                    </div>
                    <p class="text-xs text-zinc-600 leading-relaxed">
                        "Varian Lempok Durian Original-nya autentik sekali aromanya. Kemasan vacuum-nya higienis sehingga aman dibawa perjalanan jauh."
                    </p>
                </div>
                <div class="pt-3 mt-4 border-t border-zinc-200 text-xs font-bold text-zinc-900">
                    Siti Rahmawati <span class="text-zinc-400 font-normal block text-[11px] mt-0.5">Palembang</span>
                </div>
            </div>

            <div class="p-5 rounded-2xl border border-zinc-200 bg-zinc-50 flex flex-col justify-between">
                <div>
                    <div class="flex text-amber-400 gap-1 mb-3">
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                    </div>
                    <p class="text-xs text-zinc-600 leading-relaxed">
                        "Kualitas produk konsisten, manisnya pas dan tidak getir di tenggorokan. Menjadi rekomendasi wajib saat berkunjung ke Kota Bengkulu."
                    </p>
                </div>
                <div class="pt-3 mt-4 border-t border-zinc-200 text-xs font-bold text-zinc-900">
                    Hendra Wijaya <span class="text-zinc-400 font-normal block text-[11px] mt-0.5">Bengkulu</span>
                </div>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection() ?>
