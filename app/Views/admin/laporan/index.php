<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-zinc-900 tracking-tight">Laporan Rekapitulasi Penjualan</h1>
            <p class="text-xs text-zinc-500 mt-1">Laporan rekap omzet, transaksi sukses, dan performa penjualan Pratama Lempok Durian.</p>
        </div>
        <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-zinc-200 hover:bg-zinc-50 text-zinc-700 text-xs font-bold rounded-xl transition shadow-sm print:hidden">
            <i data-lucide="printer" class="w-4 h-4"></i>
            <span>Cetak Rekapitulasi</span>
        </button>
    </div>

    <!-- Stat Cards Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-zinc-200 shadow-sm">
            <span class="text-[11px] font-bold text-zinc-400 uppercase tracking-wider block mb-1">Total Pendapatan (Omzet)</span>
            <span class="text-2xl font-black text-primary tracking-tight">Rp <?= number_format($totalOmzet, 0, ',', '.') ?></span>
            <span class="text-[10px] text-emerald-600 block mt-1 font-semibold">Dari transaksi berstatus Selesai</span>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-zinc-200 shadow-sm">
            <span class="text-[11px] font-bold text-zinc-400 uppercase tracking-wider block mb-1">Pesanan Berhasil</span>
            <span class="text-2xl font-black text-emerald-600 tracking-tight"><?= $totalTransaksi ?> Pesanan</span>
            <span class="text-[10px] text-zinc-400 block mt-1">Telah diselesaikan oleh kasir</span>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-zinc-200 shadow-sm">
            <span class="text-[11px] font-bold text-zinc-400 uppercase tracking-wider block mb-1">Semua Riwayat Masuk</span>
            <span class="text-2xl font-black text-zinc-800 tracking-tight"><?= $totalSemua ?> Transaksi</span>
            <span class="text-[10px] text-zinc-400 block mt-1">Total pesanan sejak sistem aktif</span>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-zinc-200 shadow-sm">
            <span class="text-[11px] font-bold text-zinc-400 uppercase tracking-wider block mb-1">Pesanan Dibatalkan</span>
            <span class="text-2xl font-black text-red-500 tracking-tight"><?= $totalBatal ?></span>
            <span class="text-[10px] text-zinc-400 block mt-1">Stok dikembalikan ke gudang</span>
        </div>
    </div>

    <!-- Tabel Rekap Transaksi Sukses -->
    <div class="bg-white border border-zinc-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="p-4 bg-zinc-50 border-b border-zinc-200 flex items-center justify-between">
            <h3 class="text-xs font-bold text-zinc-800 uppercase tracking-wider">Rincian Transaksi Berhasil (Lunas & Selesai)</h3>
            <span class="text-[11px] text-zinc-400 font-mono"><?= date('d F Y') ?></span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-zinc-600">
                <thead class="bg-zinc-50/50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                    <tr>
                        <th class="px-5 py-3 w-12 text-center">No</th>
                        <th class="px-5 py-3">Kode Transaksi</th>
                        <th class="px-5 py-3">Tanggal Selesai</th>
                        <th class="px-5 py-3">Nama Pelanggan</th>
                        <th class="px-5 py-3">Menu & Jumlah</th>
                        <th class="px-5 py-3 text-right">Nilai Transaksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    <?php if (empty($pesananSelesai)): ?>
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center text-zinc-400">Belum ada transaksi dengan status selesai.</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($pesananSelesai as $item): ?>
                            <tr class="hover:bg-zinc-50/80 transition">
                                <td class="px-5 py-3 text-center font-bold text-zinc-400"><?= $no++ ?></td>
                                <td class="px-5 py-3 font-mono font-bold text-zinc-800"><?= esc($item['kode_pesanan']) ?></td>
                                <td class="px-5 py-3 text-zinc-400 text-[11px]"><?= date('d M Y, H:i', strtotime($item['updated_at'] ?? $item['created_at'])) ?></td>
                                <td class="px-5 py-3 font-semibold text-zinc-800"><?= esc($item['nama_pelanggan']) ?> (<?= esc($item['telepon']) ?>)</td>
                                <td class="px-5 py-3 text-zinc-700"><?= esc($item['nama_makanan'] ?? 'Lempok Durian') ?> <span class="text-zinc-400 font-mono">(x<?= esc($item['jumlah'] ?? 1) ?>)</span></td>
                                <td class="px-5 py-3 text-right font-bold text-primary">Rp <?= number_format($item['total_bayar'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="bg-zinc-50/80 font-black text-zinc-900 border-t-2 border-zinc-200">
                            <td colspan="5" class="px-5 py-3.5 text-right uppercase tracking-wider text-xs">Total Omzet Bersih:</td>
                            <td class="px-5 py-3.5 text-right text-primary text-sm font-black">Rp <?= number_format($totalOmzet, 0, ',', '.') ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
