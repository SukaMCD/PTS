<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-zinc-900 tracking-tight">Manajemen Akun Pengguna</h1>
            <p class="text-xs text-zinc-500 mt-1">Kelola data seluruh akun (Admin, Petugas, dan Pelanggan) serta hak aksesnya.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-xs font-bold px-3 py-1.5 bg-primary/10 text-primary rounded-xl">
                Total: <?= count($users) ?> Pengguna
            </span>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white p-4 rounded-2xl border border-zinc-200 shadow-sm flex items-center justify-between">
        <form action="/admin/users" method="GET" class="flex-1 max-w-md flex items-center gap-2">
            <div class="relative flex-1">
                <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-400"></i>
                <input type="text" 
                       name="q" 
                       value="<?= esc($keyword ?? '') ?>" 
                       placeholder="Cari nama, email, atau username..." 
                       class="w-full bg-zinc-50 border border-zinc-200 rounded-xl pl-10 pr-3.5 py-2 text-xs text-zinc-900 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition">
            </div>
            <button type="submit" class="px-4 py-2 bg-primary hover:bg-primary-900 text-white text-xs font-bold rounded-xl transition shadow-sm">
                Cari
            </button>
            <?php if (!empty($keyword)): ?>
                <a href="/admin/users" class="px-3 py-2 bg-zinc-100 hover:bg-zinc-200 text-zinc-600 text-xs font-semibold rounded-xl transition">
                    Reset
                </a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Data Table Users -->
    <div class="bg-white border border-zinc-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-zinc-600">
                <thead class="bg-zinc-50 text-[11px] font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-200">
                    <tr>
                        <th class="px-5 py-3.5 w-12 text-center">No</th>
                        <th class="px-5 py-3.5">Nama & Username</th>
                        <th class="px-5 py-3.5">Alamat Email</th>
                        <th class="px-5 py-3.5">Peran (Role)</th>
                        <th class="px-5 py-3.5">Terdaftar Sejak</th>
                        <th class="px-5 py-3.5 text-center w-48">Ubah Peran / Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center text-zinc-400">Tidak ada data pengguna ditemukan.</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($users as $u): ?>
                            <tr class="hover:bg-zinc-50/80 transition">
                                <td class="px-5 py-3.5 text-center font-bold text-zinc-400"><?= $no++ ?></td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-primary/10 text-primary font-bold text-xs flex items-center justify-center uppercase shrink-0">
                                            <?= substr($u['nama'], 0, 1) ?>
                                        </div>
                                        <div>
                                            <span class="block font-bold text-zinc-800"><?= esc($u['nama']) ?></span>
                                            <span class="text-[11px] text-zinc-400 font-mono">@<?= esc($u['username']) ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-zinc-600 font-medium">
                                    <?= esc($u['email']) ?>
                                </td>
                                <td class="px-5 py-3.5">
                                    <?php if ($u['role'] === 'admin'): ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                            ADMIN
                                        </span>
                                    <?php elseif ($u['role'] === 'petugas'): ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                            PETUGAS
                                        </span>
                                    <?php else: ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-zinc-100 text-zinc-600 border border-zinc-200">
                                            PELANGGAN
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-3.5 text-zinc-400 text-[11px]">
                                    <?= date('d M Y, H:i', strtotime($u['created_at'] ?? 'now')) ?>
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <?php if ($u['id'] == session()->get('user_id')): ?>
                                        <span class="text-[10px] text-zinc-400 italic font-medium">(Akun Anda)</span>
                                    <?php else: ?>
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Form Ubah Role Cepat -->
                                            <form action="/admin/users/update-role/<?= $u['id'] ?>" method="POST" class="inline-flex items-center gap-1">
                                                <?= csrf_field() ?>
                                                <select name="role" onchange="this.form.submit()" class="bg-zinc-50 border border-zinc-200 rounded-lg px-2 py-1 text-[11px] font-semibold text-zinc-700 focus:outline-none focus:ring-1 focus:ring-primary">
                                                    <option value="user" <?= ($u['role'] === 'user') ? 'selected' : '' ?>>Pelanggan</option>
                                                    <option value="petugas" <?= ($u['role'] === 'petugas') ? 'selected' : '' ?>>Petugas</option>
                                                    <option value="admin" <?= ($u['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                                                </select>
                                            </form>

                                            <!-- Hapus User -->
                                            <a href="/admin/users/delete/<?= $u['id'] ?>" 
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus akun <?= esc($u['nama']) ?>?')" 
                                               class="p-1.5 text-zinc-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" 
                                               title="Hapus Pengguna">
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            </a>
                                        </div>
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
