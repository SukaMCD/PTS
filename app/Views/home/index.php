<?= $this->extend('layout/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section (Gaya Restoran Modern ala KFC / Burger Bangor) -->
<section class="relative bg-gradient-to-br from-primary-900 via-primary-800 to-indigo-950 text-white overflow-hidden py-16 md:py-24">
    <!-- Decorative background elements -->
    <div class="absolute -right-20 -bottom-20 w-96 h-96 rounded-full bg-accent/10 blur-3xl pointer-events-none"></div>
    <div class="absolute left-10 top-10 w-72 h-72 rounded-full bg-indigo-500/10 blur-2xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Hero Text Content -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-semibold text-accent">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                    <span>Warisan Kuliner Autentik Bengkulu</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.1]">
                    SENSASI LEGIT <br>
                    <span class="text-accent underline decoration-accent/40 decoration-wavy decoration-2">DURIAN ASLI</span> BUMI RAFFLESIA
                </h1>

                <p class="text-zinc-200 text-sm sm:text-base leading-relaxed max-w-xl">
                    Pratama menghadirkan olahan <strong>Lempok Durian khas Bengkulu</strong> dengan resep otentik warisan leluhur. Menggunakan 100% daging durian pilihan tanpa tepung pengencer, dimasak secara tradisional menghasilkan cita rasa legit, kenyal, dan harum semerbak.
                </p>

                <!-- Value Highlights -->
                <div class="grid grid-cols-3 gap-4 pt-2 border-t border-white/10 max-w-lg">
                    <div>
                        <span class="block text-2xl font-black text-accent">100%</span>
                        <span class="text-[11px] text-zinc-300 font-medium">Durian Murni</span>
                    </div>
                    <div>
                        <span class="block text-2xl font-black text-accent">9+</span>
                        <span class="text-[11px] text-zinc-300 font-medium">Pilihan Variasi</span>
                    </div>
                    <div>
                        <span class="block text-2xl font-black text-accent">4.9 ★</span>
                        <span class="text-[11px] text-zinc-300 font-medium">Rating Pelanggan</span>
                    </div>
                </div>

                <!-- CTA Actions -->
                <div class="flex flex-wrap items-center gap-4 pt-3">
                    <a href="#menu" class="inline-flex items-center gap-2 bg-accent text-zinc-950 font-bold px-6 py-3.5 rounded-xl hover:bg-amber-300 transition shadow-lg shadow-accent/20 text-sm">
                        <i data-lucide="utensils" class="w-4 h-4"></i>
                        <span>Eksplorasi Menu Makanan</span>
                    </a>
                    <a href="#tentang" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold px-6 py-3.5 rounded-xl transition text-sm">
                        <span>Kenali Lempok Bengkulu</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <!-- Hero Visual Card -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md bg-white/10 backdrop-blur-xl border border-white/20 p-4 rounded-3xl shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1587132137056-bfbf0166836e?w=800&auto=format&fit=crop&q=80" 
                         alt="Lempok Durian Bengkulu" 
                         class="w-full h-80 object-cover rounded-2xl shadow-inner">
                    
                    <div class="mt-4 p-4 rounded-xl bg-white/90 backdrop-blur-md text-zinc-900 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-primary">Menu Unggulan Kami</span>
                            <h4 class="font-bold text-sm text-zinc-900">Lempok Durian Original Bengkulu</h4>
                            <span class="text-xs font-semibold text-primary">Rp 45.000 / pack</span>
                        </div>
                        <a href="#menu" class="p-2.5 rounded-xl bg-primary text-white hover:bg-primary-900 transition">
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
                <span class="text-xs font-bold uppercase tracking-widest text-primary flex items-center gap-1.5 mb-1">
                    <i data-lucide="flame" class="w-3.5 h-3.5 text-accent-600"></i> Katalog Olahan Durian
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-zinc-900 tracking-tight">Daftar Variasi Menu Pratama</h2>
                <p class="text-zinc-500 text-xs sm:text-sm mt-1">Tersedia <?= count($makanan) ?> pilihan olahan makanan khas Bengkulu berkualitas premium</p>
            </div>

            <!-- Form Pencarian & Sorting -->
            <form action="<?= base_url('/#menu') ?>" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                
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
                        <option value="rating"    <?= ($sort === 'rating') ? 'selected' : '' ?>>Rating: Tertinggi ★</option>
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
                    <div class="group bg-white border border-zinc-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:border-primary/40 transition duration-300 flex flex-col">
                        
                        <!-- Gambar Makanan -->
                        <div class="relative h-52 overflow-hidden bg-zinc-100">
                            <img src="<?= esc($item['gambar'] ?? 'https://images.unsplash.com/photo-1587132137056-bfbf0166836e?w=600&auto=format&fit=crop&q=80') ?>" 
                                 alt="<?= esc($item['nama_makanan']) ?>" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            <!-- Kategori Badge -->
                            <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[10px] font-bold bg-white/90 backdrop-blur-md text-primary shadow-sm">
                                <?= esc($item['nama_kategori'] ?? 'Lempok Bengkulu') ?>
                            </span>

                            <!-- Rating Badge -->
                            <span class="absolute top-3 right-3 px-2.5 py-1 rounded-full text-[10px] font-bold bg-zinc-950/80 backdrop-blur-md text-amber-300 flex items-center gap-1 shadow-sm">
                                <i data-lucide="star" class="w-3 h-3 fill-amber-300"></i>
                                <span><?= number_format($item['rating'], 1) ?></span>
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-1.5 text-zinc-400 text-[11px] font-semibold mb-1">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-accent-600"></i>
                                    <span><?= esc($item['asal_daerah'] ?? 'Bengkulu') ?></span>
                                    <span class="text-zinc-300">•</span>
                                    <span class="text-emerald-600 font-bold">Stok: <?= esc($item['stok']) ?></span>
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
                                    <span class="text-[10px] text-zinc-400 font-semibold block uppercase">Harga Spesial</span>
                                    <span class="font-extrabold text-base text-primary">
                                        Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                                    </span>
                                </div>

                                <a href="<?= base_url('/makanan/' . esc($item['slug'])) ?>" 
                                   class="inline-flex items-center gap-1.5 bg-primary/10 hover:bg-primary text-primary hover:text-white px-3.5 py-2 rounded-xl text-xs font-bold transition">
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
<section id="tentang" class="py-16 bg-[#f7f7f5] border-b border-zinc-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-primary flex items-center justify-center gap-1.5 mb-2">
                <i data-lucide="award" class="w-4 h-4 text-accent-600"></i> Mengapa Lempok Bengkulu Istimewa?
            </span>
            <h2 class="text-2xl sm:text-3xl font-black text-zinc-900 tracking-tight">Kelezatan Murni Tanpa Kompromi</h2>
            <p class="text-zinc-600 text-xs sm:text-sm mt-2">
                Berbeda dari dodol pada umumnya yang didominasi tepung ketan, Lempok Durian Bengkulu mempertahankan kemurnian bahan asli.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm space-y-3">
                <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                    <i data-lucide="check-check" class="w-6 h-6"></i>
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

<!-- Section Ulasan Pengunjung & Pelanggan -->
<section id="testimoni" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-primary mb-2 block">Ulasan Pelanggan</span>
            <h2 class="text-2xl sm:text-3xl font-black text-zinc-900 tracking-tight">Apa Kata Penikmat Durian?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-5 rounded-2xl border border-zinc-200 bg-zinc-50 space-y-3">
                <div class="flex text-amber-400 gap-1 text-xs">★★★★★</div>
                <p class="text-xs text-zinc-600 leading-relaxed italic">
                    "Rasanya benar-benar legit durian asli! Begitu buka kemasannya langsung wangi semerbak satu ruangan. Teksturnya kenyal pas, tidak lengket di gigi."
                </p>
                <div class="pt-2 border-t border-zinc-200 text-xs font-bold text-zinc-900">
                    Budi Santoso <span class="text-zinc-400 font-normal block text-[11px]">Wisatawan asal Jakarta</span>
                </div>
            </div>

            <div class="p-5 rounded-2xl border border-zinc-200 bg-zinc-50 space-y-3">
                <div class="flex text-amber-400 gap-1 text-xs">★★★★★</div>
                <p class="text-xs text-zinc-600 leading-relaxed italic">
                    "Varian Pancake Lempok Durian Lumernya juara banget! Inovasi modern yang sangat cerdas untuk oleh-oleh khas Bengkulu. Pasti repeat order."
                </p>
                <div class="pt-2 border-t border-zinc-200 text-xs font-bold text-zinc-900">
                    Siti Rahmawati <span class="text-zinc-400 font-normal block text-[11px]">Food Blogger Palembang</span>
                </div>
            </div>

            <div class="p-5 rounded-2xl border border-zinc-200 bg-zinc-50 space-y-3">
                <div class="flex text-amber-400 gap-1 text-xs">★★★★★</div>
                <p class="text-xs text-zinc-600 leading-relaxed italic">
                    "Packaging Royal Gift Box-nya sangat mewah dan rapi. Diberikan untuk bingkisan rekan kerja sangat membanggakan khas Bengkulu."
                </p>
                <div class="pt-2 border-t border-zinc-200 text-xs font-bold text-zinc-900">
                    Hendra Wijaya <span class="text-zinc-400 font-normal block text-[11px]">Warga Kota Bengkulu</span>
                </div>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection() ?>
