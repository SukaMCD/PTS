<?php

namespace App\Controllers;

use App\Models\PesananModel;
use App\Models\MakananModel;

class PesananController extends BaseController
{
    protected $pesananModel;
    protected $makananModel;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
        $this->makananModel = new MakananModel();
    }

    // ==========================================
    // ROLE 3: USER / PELANGGAN (Transaksi & Riwayat)
    // ==========================================

    // Proses Pemesanan Oleh Pelanggan
    public function store()
    {
        $rules = [
            'makanan_id'     => 'required|numeric',
            'jumlah'         => 'required|integer|greater_than[0]',
            'nama_pelanggan' => 'required|min_length[3]|max_length[100]',
            'telepon'        => 'required|min_length[8]|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Silakan lengkapi form pemesanan dengan benar.');
        }

        $makananId = (int) $this->request->getPost('makanan_id');
        $jumlah    = (int) $this->request->getPost('jumlah');
        $makanan   = $this->makananModel->find($makananId);

        if (!$makanan) {
            return redirect()->back()->with('error', 'Menu makanan yang dipesan tidak ditemukan.');
        }

        if ($makanan['stok'] < $jumlah) {
            return redirect()->back()->with('error', "Stok {$makanan['nama_makanan']} tidak mencukupi (Tersisa {$makanan['stok']} porsi).");
        }

        $totalBayar = $makanan['harga'] * $jumlah;
        $kodePesanan = 'PRT-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

        $data = [
            'kode_pesanan'   => $kodePesanan,
            'user_id'        => session()->get('user_id'), // null jika tamu atau terisi jika login
            'makanan_id'     => $makananId,
            'jumlah'         => $jumlah,
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'telepon'        => $this->request->getPost('telepon'),
            'catatan'        => $this->request->getPost('catatan'),
            'total_bayar'    => $totalBayar,
            'status'         => 'pending',
            'created_at'     => date('Y-m-d H:i:s'),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        // Kurangi stok makanan
        $this->makananModel->update($makananId, [
            'stok' => $makanan['stok'] - $jumlah
        ]);

        $this->pesananModel->insert($data);

        return redirect()->to('/riwayat')->with('success', "Pesanan #{$kodePesanan} berhasil dibuat! Menunggu konfirmasi petugas.");
    }

    // Riwayat Pesanan Pribadi Pelanggan
    public function riwayat(): string
    {
        $userId = session()->get('user_id');

        $query = $this->pesananModel
            ->select('pesanan.*, makanan.nama_makanan, makanan.gambar, makanan.harga as harga_satuan')
            ->join('makanan', 'makanan.id = pesanan.makanan_id', 'left')
            ->orderBy('pesanan.created_at', 'DESC');

        if ($userId) {
            $query->where('pesanan.user_id', $userId);
        }

        $pesananList = $query->findAll();

        $data = [
            'title'       => 'Riwayat Pesanan Saya — Pratama Lempok Durian',
            'pesananList' => $pesananList,
        ];

        return view('user/riwayat', $data);
    }

    // Batalkan Pesanan oleh User (Hanya jika status masih pending)
    public function batalUser(int $id)
    {
        $pesanan = $this->pesananModel->find($id);

        if (!$pesanan || $pesanan['user_id'] != session()->get('user_id')) {
            return redirect()->to('/riwayat')->with('error', 'Pesanan tidak ditemukan.');
        }

        if ($pesanan['status'] !== 'pending') {
            return redirect()->to('/riwayat')->with('error', 'Pesanan sedang diproses atau sudah selesai, tidak dapat dibatalkan.');
        }

        // Kembalikan stok
        if ($pesanan['makanan_id']) {
            $makanan = $this->makananModel->find($pesanan['makanan_id']);
            if ($makanan) {
                $this->makananModel->update($pesanan['makanan_id'], [
                    'stok' => $makanan['stok'] + ($pesanan['jumlah'] ?? 1)
                ]);
            }
        }

        $this->pesananModel->update($id, ['status' => 'dibatalkan']);

        return redirect()->to('/riwayat')->with('success', 'Pesanan berhasil dibatalkan.');
    }

    // ==========================================
    // ROLE 2: PETUGAS / OPERASIONAL KASIR
    // ==========================================

    // Panel Operasional Pesanan Petugas
    public function indexPetugas(): string
    {
        $status = $this->request->getGet('status');

        $query = $this->pesananModel
            ->select('pesanan.*, makanan.nama_makanan, makanan.gambar')
            ->join('makanan', 'makanan.id = pesanan.makanan_id', 'left')
            ->orderBy('pesanan.created_at', 'DESC');

        if ($status) {
            $query->where('pesanan.status', $status);
        }

        $data = [
            'title'        => 'Operasional Pesanan Kasir — Pratama Petugas',
            'pesanan'      => $query->findAll(),
            'currentStatus'=> $status,
            'countPending' => $this->pesananModel->where('status', 'pending')->countAllResults(),
            'countProses'  => $this->pesananModel->where('status', 'diproses')->countAllResults(),
            'countSelesai' => $this->pesananModel->where('status', 'selesai')->countAllResults(),
        ];

        return view('petugas/pesanan/index', $data);
    }

    // Validasi / Perbarui Status Pesanan oleh Petugas
    public function updateStatus(int $id)
    {
        $pesanan = $this->pesananModel->find($id);

        if (!$pesanan) {
            return redirect()->to('/petugas/pesanan')->with('error', 'Data pesanan tidak ditemukan.');
        }

        $newStatus = $this->request->getPost('status');
        if (!in_array($newStatus, ['pending', 'diproses', 'selesai', 'dibatalkan'])) {
            return redirect()->to('/petugas/pesanan')->with('error', 'Status pesanan tidak valid.');
        }

        // Jika dibatalkan oleh petugas, kembalikan stok
        if ($newStatus === 'dibatalkan' && $pesanan['status'] !== 'dibatalkan') {
            if ($pesanan['makanan_id']) {
                $makanan = $this->makananModel->find($pesanan['makanan_id']);
                if ($makanan) {
                    $this->makananModel->update($pesanan['makanan_id'], [
                        'stok' => $makanan['stok'] + ($pesanan['jumlah'] ?? 1)
                    ]);
                }
            }
        }

        $this->pesananModel->update($id, [
            'status'     => $newStatus,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/petugas/pesanan')->with('success', "Status pesanan {$pesanan['kode_pesanan']} berhasil diubah ke: " . strtoupper($newStatus));
    }

    // ==========================================
    // ROLE 1: ADMIN LAPORAN & REKAPITULASI
    // ==========================================

    public function laporanAdmin(): string
    {
        $pesananSelesai = $this->pesananModel
            ->select('pesanan.*, makanan.nama_makanan')
            ->join('makanan', 'makanan.id = pesanan.makanan_id', 'left')
            ->where('pesanan.status', 'selesai')
            ->orderBy('pesanan.created_at', 'DESC')
            ->findAll();

        $totalOmzet = 0;
        foreach ($pesananSelesai as $p) {
            $totalOmzet += $p['total_bayar'];
        }

        $data = [
            'title'          => 'Laporan Penjualan & Rekapitulasi — Pratama Admin',
            'pesananSelesai' => $pesananSelesai,
            'totalOmzet'     => $totalOmzet,
            'totalTransaksi' => count($pesananSelesai),
            'totalSemua'     => $this->pesananModel->countAllResults(),
            'totalBatal'     => $this->pesananModel->where('status', 'dibatalkan')->countAllResults(),
        ];

        return view('admin/laporan/index', $data);
    }
}
