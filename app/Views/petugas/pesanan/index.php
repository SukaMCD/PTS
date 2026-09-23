<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-zinc-900 tracking-tight">Operasional Kasir & Pesanan</h1>
            <p class="text-xs text-zinc-500 mt-1">Validasi transaksi pelanggan, update status pesanan, dan koordinasi pengiriman.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-xs font-bold px-3 py-1.5 bg-amber-50 text-amber-700 border border-amber-200 rounded-xl">
                Pending: <?= $countPending ?>
            </span>
            <span class="text-xs font-bold px-3 py-1.5 bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-xl">
                Diproses: <?= $countProses ?>
            </span>
            <span class="text-xs font-bold px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl">
                Selesai: <?= $countSelesai ?>
            </span>
        </div>
    </div>

    <!-- Filter Status Tabs -->
    <div class="flex items-center gap-2 border-b border-zinc-200 pb-3 text-xs">
        <a href="/petugas/pesanan" 
           class="px-4 py-2 rounded-xl font-bold transition <?= empty($currentStatus) ? 'bg-primary text-white shadow-sm' : 'bg-white border border-zinc-200 text-zinc-600 hover:bg-zinc-50' ?>">
            Semua Pesanan (<?= count($pesanan) ?>)
        </a>
        <a href="/petugas/pesanan?status=pending" 
           class="px-4 py-2 rounded-xl font-semibold transition <?= ($currentStatus === 'pending') ? 'bg-amber-500 text-white shadow-sm' : 'bg-white border border-zinc-200 text-zinc-600 hover:bg-zinc-50' ?>">
            Menunggu (<?= $countPending ?>)
        </a>
        <a href="/petugas/pesanan?status=diproses" 
           class="px-4 py-2 rounded-xl font-semibold transition <?= ($currentStatus === 'diproses') ? 'bg-indigo-600 text-white shadow-sm' : 'bg-white border border-zinc-200 text-zinc-600 hover:bg-zinc-50' ?>">
            Diproses (<?= $countProses ?>)
        </a>
        <a href="/petugas/pesanan?status=selesai" 
           class="px-4 py-2 rounded-xl font-semibold transition <?= ($currentStatus === 'selesai') ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white border border-zinc-200 text-zinc-600 hover:bg-zinc-50' ?>">
            Selesai (<?= $countSelesai ?>)
        </a>
    </div>

    <!-- Data Table Pesanan -->
    <div class="bg-white border border-zinc-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-zinc-600">
                <thead class="bg-zinc-50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                    <tr>
                        <th class="px-5 py-3.5 w-12 text-center">No</th>
                        <th class="px-5 py-3.5">Kode & Tanggal</th>
                        <th class="px-5 py-3.5">Pemesan (Pelanggan)</th>
                        <th class="px-5 py-3.5">Menu Dipesan</th>
                        <th class="px-5 py-3.5">Total Bayar</th>
                        <th class="px-5 py-3.5 text-center">Status</th>
                        <th class="px-5 py-3.5 text-center w-52">Aksi Kasir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    <?php if (empty($pesanan)): ?>
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-zinc-400">
                                <i data-lucide="inbox" class="w-8 h-8 text-zinc-300 mx-auto mb-2"></i>
                                Belum ada antrean pesanan dalam status ini.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($pesanan as $p): ?>
                            <tr class="hover:bg-zinc-50/80 transition">
                                <td class="px-5 py-3.5 text-center font-bold text-zinc-400"><?= $no++ ?></td>
                                <td class="px-5 py-3.5">
                                    <span class="block font-mono font-bold text-zinc-800"><?= esc($p['kode_pesanan']) ?></span>
                                    <span class="text-[10px] text-zinc-400"><?= date('d M Y, H:i', strtotime($p['created_at'] ?? 'now')) ?></span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="block font-bold text-zinc-800"><?= esc($p['nama_pelanggan']) ?></span>
                                    <span class="text-[11px] text-zinc-500 font-mono flex items-center gap-1 mt-0.5">
                                        <i data-lucide="phone" class="w-3 h-3 text-zinc-400"></i>
                                        <?= esc($p['telepon']) ?>
                                    </span>
                                    <?php if (!empty($p['catatan'])): ?>
                                        <p class="text-[10px] text-zinc-400 italic mt-1 line-clamp-1">"<?= esc($p['catatan']) ?>"</p>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="font-bold text-zinc-800 block"><?= esc($p['nama_makanan'] ?? 'Lempok Durian Pilihan') ?></span>
                                    <span class="text-[11px] text-zinc-500"><?= esc($p['jumlah'] ?? 1) ?> porsi / kotak</span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="font-bold text-primary text-sm">Rp <?= number_format($p['total_bayar'], 0, ',', '.') ?></span>
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <?php if ($p['status'] === 'pending'): ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 inline-flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            PENDING
                                        </span>
                                    <?php elseif ($p['status'] === 'diproses'): ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 inline-flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                            DIPROSES
                                        </span>
                                    <?php elseif ($p['status'] === 'selesai'): ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 inline-flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            SELESAI
                                        </span>
                                    <?php else: ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-200">
                                            BATAL
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <?php if ($p['status'] === 'pending'): ?>
                                        <div class="flex items-center justify-center gap-1.5">
                                            <form action="/petugas/pesanan/status/<?= $p['id'] ?>" method="POST">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="status" value="diproses">
                                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-[11px] shadow-sm transition">
                                                    Proses
                                                </button>
                                            </form>
                                            <form action="/petugas/pesanan/status/<?= $p['id'] ?>" method="POST" onsubmit="return confirm('Tolak pesanan ini?')">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="status" value="dibatalkan">
                                                <button type="submit" class="px-2.5 py-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 font-semibold text-[11px] transition">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    <?php elseif ($p['status'] === 'diproses'): ?>
                                        <form action="/petugas/pesanan/status/<?= $p['id'] ?>" method="POST">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="status" value="selesai">
                                            <button type="submit" class="px-4 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] shadow-sm transition flex items-center gap-1 mx-auto">
                                                <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                                <span>Selesaikan</span>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-[10px] text-zinc-400 italic">Transaksi Ditutup</span>
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
