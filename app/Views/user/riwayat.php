<?= $this->extend('layout/public') ?>

<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-zinc-200 pb-5">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-primary">Portal Pelanggan</span>
            <h1 class="text-2xl font-black text-zinc-900 tracking-tight mt-0.5">Riwayat Pesanan Saya</h1>
            <p class="text-xs text-zinc-500 mt-1">Pantau status konfirmasi dan pengantaran pesanan Lempok Durian Anda.</p>
        </div>
        <a href="/#menu" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-900 text-white px-4 py-2.5 rounded-xl text-xs font-bold transition shadow-sm self-start">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Pesan Menu Baru</span>
        </a>
    </div>

    <!-- Alert Notifications -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2 shadow-sm">
            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600 shrink-0"></i>
            <span><?= esc(session()->getFlashdata('success')) ?></span>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs font-semibold flex items-center gap-2 shadow-sm">
            <i data-lucide="alert-circle" class="w-4 h-4 text-red-600 shrink-0"></i>
            <span><?= esc(session()->getFlashdata('error')) ?></span>
        </div>
    <?php endif; ?>

    <!-- List Pesanan Cards -->
    <?php if (empty($pesananList)): ?>
        <div class="bg-white border border-zinc-200 rounded-3xl p-12 text-center shadow-sm space-y-4">
            <div class="w-16 h-16 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto">
                <i data-lucide="shopping-bag" class="w-8 h-8"></i>
            </div>
            <div class="space-y-1">
                <h3 class="font-black text-zinc-900 text-base">Belum Ada Riwayat Pesanan</h3>
                <p class="text-xs text-zinc-500 max-w-sm mx-auto">
                    Anda belum pernah melakukan pemesanan Lempok Durian. Silakan pilih varian favorit Anda dari katalog.
                </p>
            </div>
            <a href="/#menu" class="inline-flex items-center gap-2 bg-primary text-white font-bold text-xs px-5 py-2.5 rounded-xl transition hover:bg-primary-900">
                Eksplorasi Menu Sekarang
            </a>
        </div>
    <?php else: ?>
        <div class="space-y-4">
            <?php foreach ($pesananList as $p): ?>
                <div class="bg-white border border-zinc-200 rounded-2xl p-5 sm:p-6 shadow-sm hover:shadow-md transition space-y-4">
                    
                    <!-- Header Card -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-zinc-100 pb-3">
                        <div class="flex items-center gap-2.5">
                            <span class="font-mono font-bold text-xs text-zinc-800">#<?= esc($p['kode_pesanan']) ?></span>
                            <span class="text-zinc-300">•</span>
                            <span class="text-xs text-zinc-400"><?= date('d F Y, H:i', strtotime($p['created_at'])) ?></span>
                        </div>

                        <!-- Status Badge -->
                        <div>
                            <?php if ($p['status'] === 'pending'): ?>
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200 inline-flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                    Menunggu Konfirmasi Kasir
                                </span>
                            <?php elseif ($p['status'] === 'diproses'): ?>
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 inline-flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                    Sedang Disiapkan / Dikirim
                                </span>
                            <?php elseif ($p['status'] === 'selesai'): ?>
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 inline-flex items-center gap-1.5">
                                    <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    Pesanan Selesai
                                </span>
                            <?php else: ?>
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-red-50 text-red-700 border border-red-200">
                                    Dibatalkan
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Detail Body -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <?php 
                                $foodImg = $p['gambar'] ?: 'https://images.unsplash.com/photo-1587132137056-bfbf0166836e?w=600&auto=format&fit=crop&q=80';
                                $foodImgUrl = (strpos($foodImg, 'http') === 0) ? $foodImg : base_url($foodImg);
                            ?>
                            <img src="<?= esc($foodImgUrl) ?>" alt="" class="w-16 h-16 rounded-xl object-cover border border-zinc-200 shrink-0">
                            <div>
                                <h4 class="font-black text-sm text-zinc-900"><?= esc($p['nama_makanan'] ?? 'Menu Lempok Durian') ?></h4>
                                <p class="text-xs text-zinc-500 mt-0.5">
                                    Jumlah: <span class="font-bold text-zinc-800"><?= esc($p['jumlah'] ?? 1) ?> porsi</span> 
                                    (Rp <?= number_format($p['harga_satuan'] ?? ($p['total_bayar'] / max(1, $p['jumlah'])), 0, ',', '.') ?> / porsi)
                                </p>
                                <?php if (!empty($p['catatan'])): ?>
                                    <p class="text-[11px] text-zinc-400 italic mt-1">Catatan: "<?= esc($p['catatan']) ?>"</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="text-left sm:text-right border-t sm:border-t-0 pt-3 sm:pt-0 border-zinc-100 flex sm:flex-col justify-between items-end">
                            <div>
                                <span class="text-[10px] text-zinc-400 uppercase font-bold block">Total Pembayaran</span>
                                <span class="text-base font-black text-primary block mt-0.5">Rp <?= number_format($p['total_bayar'], 0, ',', '.') ?></span>
                            </div>

                            <?php if ($p['status'] === 'pending'): ?>
                                <div class="mt-2">
                                    <a href="/pesanan/batal/<?= $p['id'] ?>" 
                                       onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')" 
                                       class="text-[11px] font-bold text-red-600 hover:text-red-800 underline">
                                        Batalkan Pesanan
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>
