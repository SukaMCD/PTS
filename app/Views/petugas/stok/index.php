<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-zinc-900 tracking-tight">Monitoring Stok Menu Outlet</h1>
            <p class="text-xs text-zinc-500 mt-1">Pantau ketersediaan fisik stok variasi Lempok Durian untuk operasional harian.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-xs font-bold px-3 py-1.5 bg-primary/10 text-primary rounded-xl">
                Total: <?= count($makanan) ?> Menu
            </span>
        </div>
    </div>

    <!-- Search in Stok -->
    <div class="bg-white p-4 rounded-2xl border border-zinc-200 shadow-sm flex items-center justify-between">
        <form action="/petugas/stok" method="GET" class="flex-1 max-w-md flex items-center gap-2">
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

    <!-- Data Table Stok -->
    <div class="bg-white border border-zinc-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-zinc-600">
                <thead class="bg-zinc-50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                    <tr>
                        <th class="px-5 py-3.5 w-12 text-center">No</th>
                        <th class="px-5 py-3.5">Menu Makanan</th>
                        <th class="px-5 py-3.5">Kategori</th>
                        <th class="px-5 py-3.5">Harga Jual</th>
                        <th class="px-5 py-3.5 text-center">Sisa Stok</th>
                        <th class="px-5 py-3.5 text-center">Status Stok</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    <?php if (empty($makanan)): ?>
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center text-zinc-400">Data menu tidak ditemukan.</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($makanan as $m): ?>
                            <tr class="hover:bg-zinc-50/80 transition">
                                <td class="px-5 py-3.5 text-center font-bold text-zinc-400"><?= $no++ ?></td>
                                <td class="px-5 py-3.5 font-semibold text-zinc-900 flex items-center gap-3">
                                    <?php 
                                        $img = $m['gambar'] ?: 'https://images.unsplash.com/photo-1587132137056-bfbf0166836e?w=600&auto=format&fit=crop&q=80';
                                        $imgUrl = (strpos($img, 'http') === 0) ? $img : base_url($img);
                                    ?>
                                    <img src="<?= esc($imgUrl) ?>" alt="" class="w-10 h-10 object-cover rounded-lg border border-zinc-200 shrink-0">
                                    <div>
                                        <span class="block font-bold text-zinc-800"><?= esc($m['nama_makanan']) ?></span>
                                        <span class="text-[10px] text-zinc-400 font-normal"><?= esc($m['asal_daerah']) ?></span>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-zinc-500 font-medium">
                                    <?= esc($m['nama_kategori'] ?? 'Lempok Durian') ?>
                                </td>
                                <td class="px-5 py-3.5 font-bold text-zinc-900">
                                    Rp <?= number_format($m['harga'], 0, ',', '.') ?>
                                </td>
                                <td class="px-5 py-3.5 text-center font-bold text-sm <?= ($m['stok'] <= 5) ? 'text-red-600' : 'text-zinc-800' ?>">
                                    <?= esc($m['stok']) ?> pcs
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <?php if ($m['stok'] <= 0): ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-200">
                                            HABIS
                                        </span>
                                    <?php elseif ($m['stok'] <= 5): ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                            MENIPIS
                                        </span>
                                    <?php else: ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            TERSEDIA
                                        </span>
                                    <?php endif; ?>
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
