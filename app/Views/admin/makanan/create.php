<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>

<div class="max-w-3xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-zinc-900 tracking-tight">Tambah Menu Lempok Durian</h1>
            <p class="text-xs text-zinc-500 mt-1">Masukkan informasi variasi menu makanan baru untuk dipromosikan.</p>
        </div>
        <a href="/admin/makanan" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white border border-zinc-200 rounded-3xl p-6 sm:p-8 shadow-sm">
        <form action="/admin/makanan/store" method="POST" class="space-y-5">
            <?= csrf_field() ?>

            <!-- Nama Makanan & Kategori -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Nama Menu Makanan *</label>
                    <input type="text" 
                           name="nama_makanan" 
                           value="<?= old('nama_makanan') ?>" 
                           required 
                           placeholder="Contoh: Lempok Durian Super Tembaga"
                           class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Kategori Menu *</label>
                    <select name="kategori_id" required class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategoriList as $k): ?>
                            <option value="<?= $k['id'] ?>" <?= (old('kategori_id') == $k['id']) ? 'selected' : '' ?>>
                                <?= esc($k['nama_kategori']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Asal Daerah, Harga & Stok -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Asal Daerah *</label>
                    <input type="text" 
                           name="asal_daerah" 
                           value="<?= old('asal_daerah', 'Bengkulu') ?>" 
                           required 
                           class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Harga (Rp) *</label>
                    <input type="number" 
                           name="harga" 
                           value="<?= old('harga') ?>" 
                           required 
                           placeholder="45000"
                           class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Stok Awal (pcs) *</label>
                    <input type="number" 
                           name="stok" 
                           value="<?= old('stok', 10) ?>" 
                           required 
                           class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                </div>
            </div>

            <!-- URL Gambar & Rating -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">URL Gambar Makanan</label>
                    <input type="url" 
                           name="gambar" 
                           value="<?= old('gambar') ?>" 
                           placeholder="https://images.unsplash.com/..."
                           class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Rating (0 - 5.0)</label>
                    <input type="number" 
                           step="0.1" 
                           min="1" 
                           max="5" 
                           name="rating" 
                           value="<?= old('rating', 4.8) ?>" 
                           class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                </div>
            </div>

            <!-- Deskripsi Singkat -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Deskripsi Singkat (Ringkasan Rasa) *</label>
                <input type="text" 
                       name="deskripsi_singkat" 
                       value="<?= old('deskripsi_singkat') ?>" 
                       required 
                       placeholder="Olahan durian murni khas Bengkulu bertekstur kenyal legit..."
                       class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
            </div>

            <!-- Deskripsi Lengkap -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Deskripsi Lengkap & Komposisi</label>
                <textarea name="deskripsi_lengkap" 
                          rows="4" 
                          placeholder="Jelaskan proses pembuatan tradisional, resep bahan baku, dan keunggulan rasa..."
                          class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition"><?= old('deskripsi_lengkap') ?></textarea>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-zinc-100 flex items-center justify-end gap-3">
                <a href="/admin/makanan" class="px-5 py-2.5 rounded-xl border border-zinc-200 text-xs font-semibold text-zinc-600 hover:bg-zinc-50 transition">
                    Batal
                </a>
                <button type="submit" class="bg-primary hover:bg-indigo-900 text-white text-xs font-bold px-6 py-2.5 rounded-xl transition shadow-sm">
                    Simpan Menu Baru
                </button>
            </div>
        </form>
    </div>

</div>

<?= $this->endSection() ?>
