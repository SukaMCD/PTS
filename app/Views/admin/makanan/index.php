<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    
    <!-- Title & Add Button -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-zinc-900 tracking-tight">Katalog Menu Makanan</h1>
            <p class="text-xs text-zinc-500 mt-1">Kelola variasi Lempok Durian khas Bengkulu yang ditampilkan pada website publik.</p>
        </div>

        <a href="/admin/makanan/create" class="inline-flex items-center gap-2 bg-primary hover:bg-indigo-900 text-white font-bold px-4 py-2.5 rounded-xl text-xs transition shadow-sm self-start sm:self-auto">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Tambah Variasi Menu Baru</span>
        </a>
    </div>

    <!-- Stats Counter Bar -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-zinc-200 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                <i data-lucide="utensils" class="w-5 h-5"></i>
            </div>
            <div>
                <span class="text-[11px] text-zinc-400 font-semibold uppercase block">Total Variasi Terdaftar</span>
                <span class="text-xl font-extrabold text-zinc-900"><?= $totalMenu ?> Menu</span>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-zinc-200 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center font-bold">
                <i data-lucide="star" class="w-5 h-5"></i>
            </div>
            <div>
                <span class="text-[11px] text-zinc-400 font-semibold uppercase block">Standar Minimal Soal</span>
                <span class="text-xl font-extrabold text-emerald-600">Minimal 8 (Tercapai)</span>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-zinc-200 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-accent/20 text-amber-900 flex items-center justify-center font-bold">
                <i data-lucide="map-pin" class="w-5 h-5"></i>
            </div>
            <div>
                <span class="text-[11px] text-zinc-400 font-semibold uppercase block">Komoditas Asli</span>
                <span class="text-xl font-extrabold text-zinc-900">Bengkulu</span>
            </div>
        </div>
    </div>

    <!-- Search in Admin Panel -->
    <div class="bg-white p-4 rounded-2xl border border-zinc-200 shadow-sm flex items-center justify-between">
        <form action="/admin/makanan" method="GET" class="flex-1 max-w-md flex items-center gap-2">
            <div class="relative flex-1">
                <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-400"></i>
                <input type="text" 
                       name="q" 
                       value="<?= esc($keyword ?? '') ?>" 
                       placeholder="Cari nama menu..." 
                       class="w-full bg-zinc-50 border border-zinc-200 rounded-xl pl-10 pr-3.5 py-2 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
            </div>
            <button type="submit" class="px-3.5 py-2 bg-zinc-100 hover:bg-zinc-200 text-zinc-700 text-xs font-bold rounded-xl transition">
                Cari
            </button>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white border border-zinc-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-zinc-600">
                <thead class="bg-zinc-50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                    <tr>
                        <th class="px-5 py-3.5 w-12 text-center">No</th>
                        <th class="px-5 py-3.5">Menu Makanan</th>
                        <th class="px-5 py-3.5">Kategori</th>
                        <th class="px-5 py-3.5">Harga</th>
                        <th class="px-5 py-3.5">Stok</th>
                        <th class="px-5 py-3.5">Rating</th>
                        <th class="px-5 py-3.5 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    <?php if (empty($makanan)): ?>
                        <tr>
                            <td colspan="7" class="px-5 py-8 text-center text-zinc-400">Belum ada data menu makanan.</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($makanan as $m): ?>
                            <tr class="hover:bg-zinc-50/80 transition">
                                <td class="px-5 py-3 text-center font-bold text-zinc-400"><?= $no++ ?></td>
                                <td class="px-5 py-3 font-semibold text-zinc-900 flex items-center gap-3">
                                    <img src="<?= esc($m['gambar']) ?>" alt="" class="w-10 h-10 object-cover rounded-lg border border-zinc-200 shrink-0">
                                    <div>
                                        <span class="block font-bold text-zinc-800"><?= esc($m['nama_makanan']) ?></span>
                                        <span class="text-[10px] text-zinc-400 font-normal"><?= esc($m['asal_daerah']) ?></span>
                                    </div>
                                </td>
                                <td class="px-5 py-3">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-primary/10 text-primary border border-primary/20">
                                        <?= esc($m['nama_kategori'] ?? 'Lempok Bengkulu') ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3 font-bold text-primary">
                                    Rp <?= number_format($m['harga'], 0, ',', '.') ?>
                                </td>
                                <td class="px-5 py-3">
                                    <span class="font-semibold <?= ($m['stok'] > 10) ? 'text-emerald-600' : 'text-amber-600' ?>">
                                        <?= esc($m['stok']) ?> pcs
                                    </span>
                                </td>
                                <td class="px-5 py-3 font-semibold text-amber-500 flex items-center gap-1">
                                    <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400"></i>
                                    <span><?= number_format($m['rating'], 1) ?></span>
                                </td>
                                <td class="px-5 py-3 text-center">
                                    <div class="inline-flex items-center gap-1.5">
                                        <a href="/admin/makanan/edit/<?= $m['id'] ?>" class="p-1.5 rounded-lg bg-zinc-100 hover:bg-primary hover:text-white text-zinc-600 transition" title="Edit Data">
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        </a>
                                        <a href="/admin/makanan/delete/<?= $m['id'] ?>" onclick="return confirm('Hapus menu <?= esc($m['nama_makanan']) ?>?')" class="p-1.5 rounded-lg bg-zinc-100 hover:bg-red-600 hover:text-white text-zinc-600 transition" title="Hapus Data">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
