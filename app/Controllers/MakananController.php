<?php

namespace App\Controllers;

use App\Models\MakananModel;
use App\Models\KategoriModel;

class MakananController extends BaseController
{
    protected $makananModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->makananModel  = new MakananModel();
        $this->kategoriModel = new KategoriModel();
    }

    // Tampilkan Daftar Makanan (Admin Panel)
    public function index(): string
    {
        $keyword = $this->request->getGet('q');
        $sort    = $this->request->getGet('sort');

        $data = [
            'title'        => 'Manajemen Menu Makanan — Pratama Admin',
            'makanan'      => $this->makananModel->getMakananFiltered($keyword, $sort),
            'kategoriList' => $this->kategoriModel->findAll(),
            'totalMenu'    => $this->makananModel->countAllResults(),
            'keyword'      => $keyword,
            'sort'         => $sort,
        ];

        return view('admin/makanan/index', $data);
    }

    // Form Tambah Menu Baru
    public function create(): string
    {
        $data = [
            'title'        => 'Tambah Menu Lempok Durian Baru',
            'kategoriList' => $this->kategoriModel->findAll(),
        ];

        return view('admin/makanan/create', $data);
    }

    // Simpan Menu Baru ke Database
    public function store()
    {
        $rules = [
            'nama_makanan'      => 'required|min_length[3]|max_length[150]',
            'kategori_id'       => 'required|numeric',
            'harga'             => 'required|numeric|greater_than[0]',
            'stok'              => 'required|integer|greater_than_equal_to[0]',
            'deskripsi_singkat' => 'required|min_length[5]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $namaMakanan = $this->request->getPost('nama_makanan');
        $slug = url_title($namaMakanan, '-', true) . '-' . time();

        $data = [
            'kategori_id'       => $this->request->getPost('kategori_id'),
            'nama_makanan'      => $namaMakanan,
            'slug'              => $slug,
            'asal_daerah'       => $this->request->getPost('asal_daerah') ?: 'Bengkulu',
            'deskripsi_singkat' => $this->request->getPost('deskripsi_singkat'),
            'deskripsi_lengkap' => $this->request->getPost('deskripsi_lengkap'),
            'harga'             => $this->request->getPost('harga'),
            'stok'              => $this->request->getPost('stok'),
            'rating'            => $this->request->getPost('rating') ?: 4.8,
            'gambar'            => $this->request->getPost('gambar') ?: 'https://images.unsplash.com/photo-1587132137056-bfbf0166836e?w=600&auto=format&fit=crop&q=80',
        ];

        $this->makananModel->insert($data);

        return redirect()->to('/admin/makanan')->with('success', 'Menu makanan baru berhasil ditambahkan.');
    }

    // Form Edit Menu
    public function edit(int $id): string
    {
        $makanan = $this->makananModel->find($id);

        if (!$makanan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Menu dengan ID {$id} tidak ditemukan.");
        }

        $data = [
            'title'        => 'Ubah Data Menu: ' . $makanan['nama_makanan'],
            'makanan'      => $makanan,
            'kategoriList' => $this->kategoriModel->findAll(),
        ];

        return view('admin/makanan/edit', $data);
    }

    // Simpan Perubahan Menu
    public function update(int $id)
    {
        $makanan = $this->makananModel->find($id);

        if (!$makanan) {
            return redirect()->to('/admin/makanan')->with('error', 'Menu tidak ditemukan.');
        }

        $rules = [
            'nama_makanan'      => 'required|min_length[3]|max_length[150]',
            'kategori_id'       => 'required|numeric',
            'harga'             => 'required|numeric|greater_than[0]',
            'stok'              => 'required|integer|greater_than_equal_to[0]',
            'deskripsi_singkat' => 'required|min_length[5]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'kategori_id'       => $this->request->getPost('kategori_id'),
            'nama_makanan'      => $this->request->getPost('nama_makanan'),
            'asal_daerah'       => $this->request->getPost('asal_daerah'),
            'deskripsi_singkat' => $this->request->getPost('deskripsi_singkat'),
            'deskripsi_lengkap' => $this->request->getPost('deskripsi_lengkap'),
            'harga'             => $this->request->getPost('harga'),
            'stok'              => $this->request->getPost('stok'),
            'rating'            => $this->request->getPost('rating'),
            'gambar'            => $this->request->getPost('gambar'),
        ];

        $this->makananModel->update($id, $data);

        return redirect()->to('/admin/makanan')->with('success', 'Data menu makanan berhasil diperbarui.');
    }

    // Hapus Menu
    public function delete(int $id)
    {
        $makanan = $this->makananModel->find($id);

        if ($makanan) {
            $this->makananModel->delete($id);
            return redirect()->to('/admin/makanan')->with('success', 'Menu makanan berhasil dihapus.');
        }

        return redirect()->to('/admin/makanan')->with('error', 'Data tidak ditemukan.');
    }
}
