<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>

<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<div class="max-w-3xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-zinc-900 tracking-tight">Edit Menu Makanan</h1>
            <p class="text-xs text-zinc-500 mt-1">Perbarui rincian harga, stok, atau deskripsi rasa Lempok Durian.</p>
        </div>
        <a href="/admin/makanan" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white border border-zinc-200 rounded-3xl p-6 sm:p-8 shadow-sm">
        <form action="/admin/makanan/update/<?= $makanan['id'] ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
            <?= csrf_field() ?>

            <!-- Nama Makanan & Kategori -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Nama Menu Makanan *</label>
                    <input type="text" 
                           name="nama_makanan" 
                           value="<?= old('nama_makanan', $makanan['nama_makanan']) ?>" 
                           required 
                           class="w-full bg-zinc-50 border <?= isset($errors['nama_makanan']) ? 'border-red-500 focus:ring-red-500' : 'border-zinc-200 focus:ring-primary' ?> rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:bg-white transition">
                    <?php if (isset($errors['nama_makanan'])): ?>
                        <p class="text-[11px] text-red-500 mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> <?= esc($errors['nama_makanan']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Kategori Menu *</label>
                    <select name="kategori_id" required class="w-full bg-zinc-50 border <?= isset($errors['kategori_id']) ? 'border-red-500 focus:ring-red-500' : 'border-zinc-200 focus:ring-primary' ?> rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:bg-white transition">
                        <?php foreach ($kategoriList as $k): ?>
                            <option value="<?= $k['id'] ?>" <?= (old('kategori_id', $makanan['kategori_id']) == $k['id']) ? 'selected' : '' ?>>
                                <?= esc($k['nama_kategori']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['kategori_id'])): ?>
                        <p class="text-[11px] text-red-500 mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> <?= esc($errors['kategori_id']) ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Asal Daerah, Harga (Titik Ribuan) & Stok -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Asal Daerah *</label>
                    <input type="text" 
                           name="asal_daerah" 
                           value="<?= old('asal_daerah', $makanan['asal_daerah']) ?>" 
                           required 
                           class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Harga (Rp) *</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-zinc-400">Rp</span>
                        <?php 
                            $hargaVal = old('harga', $makanan['harga']);
                            $cleanVal = (int) preg_replace('/[^0-9]/', '', (string)$hargaVal);
                            $formattedHarga = number_format($cleanVal, 0, ',', '.');
                        ?>
                        <input type="text" 
                               id="input_harga"
                               name="harga" 
                               value="<?= esc($formattedHarga) ?>" 
                               required 
                               placeholder="45.000"
                               class="w-full bg-zinc-50 border <?= isset($errors['harga']) ? 'border-red-500 focus:ring-red-500' : 'border-zinc-200 focus:ring-primary' ?> rounded-xl pl-10 pr-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:bg-white transition">
                    </div>
                    <?php if (isset($errors['harga'])): ?>
                        <p class="text-[11px] text-red-500 mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> <?= esc($errors['harga']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Stok (pcs) *</label>
                    <input type="number" 
                           name="stok" 
                           value="<?= old('stok', $makanan['stok']) ?>" 
                           required 
                           min="0"
                           class="w-full bg-zinc-50 border <?= isset($errors['stok']) ? 'border-red-500 focus:ring-red-500' : 'border-zinc-200 focus:ring-primary' ?> rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:bg-white transition">
                    <?php if (isset($errors['stok'])): ?>
                        <p class="text-[11px] text-red-500 mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> <?= esc($errors['stok']) ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Upload Gambar (File Picker) & Rating -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-start">
                <div class="sm:col-span-2 space-y-3">
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600">Foto Menu (Upload File / URL)</label>
                    
                    <label for="foto_input" id="drop_zone" class="block border-2 border-dashed <?= isset($errors['foto']) ? 'border-red-400 bg-red-50/20' : 'border-zinc-200 hover:border-primary/50 bg-zinc-50/50' ?> rounded-2xl p-4 text-center cursor-pointer transition relative group">
                        <input type="file" 
                               name="foto" 
                               id="foto_input" 
                               accept="image/png,image/jpeg,image/jpg,image/webp" 
                               class="sr-only">
                        
                        <div class="flex items-center gap-4 text-left pointer-events-none">
                            <?php 
                                $currentImg = $makanan['gambar'] ?: 'https://images.unsplash.com/photo-1587132137056-bfbf0166836e?w=600&auto=format&fit=crop&q=80';
                                $imgSrc = (strpos($currentImg, 'http') === 0) ? $currentImg : base_url($currentImg);
                            ?>
                            <img id="image_preview" src="<?= esc($imgSrc) ?>" alt="Preview" class="w-16 h-16 object-cover rounded-xl border border-zinc-200 shadow-sm shrink-0">
                            <div class="overflow-hidden flex-1">
                                <p id="file_name" class="text-xs font-bold text-zinc-800 truncate">Foto Saat Ini</p>
                                <p id="file_size" class="text-[10px] text-zinc-400 mt-0.5">Klik untuk memilih berkas foto baru (Maks 2 MB)</p>
                                <span class="text-[11px] font-semibold text-primary inline-flex items-center gap-1 mt-1">
                                    <i data-lucide="upload" class="w-3 h-3"></i>
                                    <span>Ganti File Gambar</span>
                                </span>
                            </div>
                        </div>
                    </label>

                    <!-- Opsi Tambahan: Masukkan URL Gambar Langsung -->
                    <div class="pt-1">
                        <label class="block text-[10px] font-bold uppercase text-zinc-400 mb-1">Atau Gunakan Link URL Gambar Baru (Opsional):</label>
                        <input type="url" 
                               name="gambar_url" 
                               value="<?= old('gambar_url') ?>" 
                               placeholder="https://images.unsplash.com/..." 
                               class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3 py-2 text-xs text-zinc-700 focus:outline-none focus:ring-1 focus:ring-primary">
                    </div>

                    <?php if (isset($errors['foto'])): ?>
                        <p class="text-[11px] text-red-500 mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> <?= esc($errors['foto']) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Rating (0 - 5.0)</label>
                    <div class="relative">
                        <input type="number" 
                               step="0.1" 
                               min="1" 
                               max="5" 
                               name="rating" 
                               value="<?= old('rating', $makanan['rating']) ?>" 
                               class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
                        <i data-lucide="star" class="w-4 h-4 text-amber-400 fill-amber-400 absolute right-3.5 top-1/2 -translate-y-1/2"></i>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Singkat -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Deskripsi Singkat (Ringkasan Rasa) *</label>
                <input type="text" 
                       name="deskripsi_singkat" 
                       value="<?= old('deskripsi_singkat', $makanan['deskripsi_singkat']) ?>" 
                       required 
                       class="w-full bg-zinc-50 border <?= isset($errors['deskripsi_singkat']) ? 'border-red-500 focus:ring-red-500' : 'border-zinc-200 focus:ring-primary' ?> rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:bg-white transition">
                <?php if (isset($errors['deskripsi_singkat'])): ?>
                    <p class="text-[11px] text-red-500 mt-1 flex items-center gap-1">
                        <i data-lucide="alert-circle" class="w-3 h-3"></i> <?= esc($errors['deskripsi_singkat']) ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Deskripsi Lengkap -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-1.5">Deskripsi Lengkap & Komposisi</label>
                <textarea name="deskripsi_lengkap" 
                          rows="4" 
                          class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition"><?= old('deskripsi_lengkap', $makanan['deskripsi_lengkap']) ?></textarea>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-zinc-100 flex items-center justify-end gap-3">
                <a href="/admin/makanan" class="px-5 py-2.5 rounded-xl border border-zinc-200 text-xs font-semibold text-zinc-600 hover:bg-zinc-50 transition">
                    Batal
                </a>
                <button type="submit" class="bg-primary hover:bg-indigo-900 text-white text-xs font-bold px-6 py-2.5 rounded-xl transition shadow-sm flex items-center gap-1.5">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    // Format input harga dengan titik ribuan secara dinamis
    const inputHarga = document.getElementById('input_harga');
    if (inputHarga) {
        inputHarga.addEventListener('input', function(e) {
            let val = this.value.replace(/[^0-9]/g, '');
            this.value = val ? new Intl.NumberFormat('id-ID').format(val) : '';
        });
    }

    // Penanganan File Picker dan Live Preview
    const fotoInput = document.getElementById('foto_input');
    const imagePreview = document.getElementById('image_preview');
    const fileName = document.getElementById('file_name');
    const fileSize = document.getElementById('file_size');

    if (fotoInput) {
        fotoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    fileName.textContent = file.name;
                    fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB (Baru)';
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>

<?= $this->endSection() ?>
