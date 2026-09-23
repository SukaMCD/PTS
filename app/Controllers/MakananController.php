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

    // Monitoring Stok Menu (Petugas & Kasir)
    public function stokPetugas(): string
    {
        $keyword = $this->request->getGet('q');
        $sort    = $this->request->getGet('sort') ?? 'stok_terkecil';

        $data = [
            'title'        => 'Monitoring Stok Outlet — Pratama Petugas',
            'makanan'      => $this->makananModel->getMakananFiltered($keyword, $sort),
            'totalMenu'    => $this->makananModel->countAllResults(),
            'keyword'      => $keyword,
        ];

        return view('petugas/stok/index', $data);
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
        // Ambil dan bersihkan format titik ribuan pada harga (misal: "45.000" -> 45000)
        $rawHarga = (string) $this->request->getPost('harga');
        $cleanHarga = preg_replace('/[^0-9]/', '', $rawHarga);

        $rules = [
            'nama_makanan' => [
                'rules'  => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required'   => 'Nama menu makanan wajib diisi.',
                    'min_length' => 'Nama makanan minimal harus 3 karakter.',
                    'max_length' => 'Nama makanan maksimal 150 karakter.',
                ],
            ],
            'kategori_id' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Pilih salah satu kategori menu makanan.',
                    'numeric'  => 'ID kategori tidak valid.',
                ],
            ],
            'stok' => [
                'rules'  => 'required|integer|greater_than_equal_to[0]',
                'errors' => [
                    'required'              => 'Stok menu wajib diisi.',
                    'integer'               => 'Stok harus berupa bilangan bulat.',
                    'greater_than_equal_to' => 'Stok tidak boleh bernilai negatif.',
                ],
            ],
            'deskripsi_singkat' => [
                'rules'  => 'required|min_length[5]|max_length[255]',
                'errors' => [
                    'required'   => 'Deskripsi singkat rasa wajib diisi.',
                    'min_length' => 'Deskripsi singkat minimal 5 karakter.',
                    'max_length' => 'Deskripsi singkat maksimal 255 karakter.',
                ],
            ],
        ];

        // Validasi khusus file gambar jika pengguna melampirkan berkas
        $fotoFile = $this->request->getFile('foto');
        if ($fotoFile && $fotoFile->getError() !== UPLOAD_ERR_NO_FILE) {
            if (!$fotoFile->isValid()) {
                $errCode = $fotoFile->getError();
                $pesanError = ($errCode === UPLOAD_ERR_INI_SIZE || $errCode === UPLOAD_ERR_FORM_SIZE)
                    ? 'Ukuran file gambar melebihi batas upload server (Maksimal 2 MB). Silakan pilih foto dengan resolusi/ukuran lebih kecil.'
                    : 'Gagal mengunggah berkas: ' . $fotoFile->getErrorString();
                return redirect()->back()->withInput()->with('errors', ['foto' => $pesanError]);
            }

            $rules['foto'] = [
                'rules'  => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/webp]|max_size[foto,2048]',
                'errors' => [
                    'is_image' => 'Berkas yang diunggah harus berupa file gambar valid.',
                    'mime_in'  => 'Format gambar yang diizinkan hanya JPG, JPEG, PNG, atau WEBP.',
                    'max_size' => 'Ukuran file gambar maksimal 2 MB.',
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($cleanHarga === '' || (int) $cleanHarga <= 0) {
            return redirect()->back()->withInput()->with('errors', ['harga' => 'Harga makanan harus lebih besar dari Rp 0.']);
        }

        $namaMakanan = $this->request->getPost('nama_makanan');
        $slug = url_title($namaMakanan, '-', true) . '-' . time();

        // Tentukan path gambar: Prioritas 1: File upload lokal, Prioritas 2: Input URL gambar, Prioritas 3: Default Unsplash
        $gambarUrlInput = trim((string) $this->request->getPost('gambar_url'));
        $gambarPath = $gambarUrlInput ?: 'https://images.unsplash.com/photo-1587132137056-bfbf0166836e?w=600&auto=format&fit=crop&q=80';

        if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
            $namaFoto = $fotoFile->getRandomName();
            $fotoFile->move(FCPATH . 'uploads/makanan', $namaFoto);
            $gambarPath = 'uploads/makanan/' . $namaFoto;
        }

        $data = [
            'kategori_id'       => $this->request->getPost('kategori_id'),
            'nama_makanan'      => $namaMakanan,
            'slug'              => $slug,
            'asal_daerah'       => $this->request->getPost('asal_daerah') ?: 'Bengkulu',
            'deskripsi_singkat' => $this->request->getPost('deskripsi_singkat'),
            'deskripsi_lengkap' => $this->request->getPost('deskripsi_lengkap'),
            'harga'             => (int) $cleanHarga,
            'stok'              => (int) $this->request->getPost('stok'),
            'rating'            => $this->request->getPost('rating') ?: 4.8,
            'gambar'            => $gambarPath,
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

        // Ambil dan bersihkan harga titik ribuan
        $rawHarga = (string) $this->request->getPost('harga');
        $cleanHarga = preg_replace('/[^0-9]/', '', $rawHarga);

        $rules = [
            'nama_makanan' => [
                'rules'  => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required'   => 'Nama menu makanan wajib diisi.',
                    'min_length' => 'Nama makanan minimal harus 3 karakter.',
                    'max_length' => 'Nama makanan maksimal 150 karakter.',
                ],
            ],
            'kategori_id' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Pilih salah satu kategori menu makanan.',
                    'numeric'  => 'ID kategori tidak valid.',
                ],
            ],
            'stok' => [
                'rules'  => 'required|integer|greater_than_equal_to[0]',
                'errors' => [
                    'required'              => 'Stok menu wajib diisi.',
                    'integer'               => 'Stok harus berupa bilangan bulat.',
                    'greater_than_equal_to' => 'Stok tidak boleh bernilai negatif.',
                ],
            ],
            'deskripsi_singkat' => [
                'rules'  => 'required|min_length[5]|max_length[255]',
                'errors' => [
                    'required'   => 'Deskripsi singkat rasa wajib diisi.',
                    'min_length' => 'Deskripsi singkat minimal 5 karakter.',
                    'max_length' => 'Deskripsi singkat maksimal 255 karakter.',
                ],
            ],
        ];

        // Validasi upload foto jika memilih gambar baru
        $fotoFile = $this->request->getFile('foto');
        if ($fotoFile && $fotoFile->getError() !== UPLOAD_ERR_NO_FILE) {
            if (!$fotoFile->isValid()) {
                $errCode = $fotoFile->getError();
                $pesanError = ($errCode === UPLOAD_ERR_INI_SIZE || $errCode === UPLOAD_ERR_FORM_SIZE)
                    ? 'Ukuran file gambar melebihi batas upload server (Maksimal 2 MB). Silakan pilih foto dengan resolusi/ukuran lebih kecil.'
                    : 'Gagal mengunggah berkas: ' . $fotoFile->getErrorString();
                return redirect()->back()->withInput()->with('errors', ['foto' => $pesanError]);
            }

            $rules['foto'] = [
                'rules'  => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/webp]|max_size[foto,2048]',
                'errors' => [
                    'is_image' => 'Berkas yang diunggah harus berupa file gambar valid.',
                    'mime_in'  => 'Format gambar yang diizinkan hanya JPG, JPEG, PNG, atau WEBP.',
                    'max_size' => 'Ukuran file gambar maksimal 2 MB.',
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($cleanHarga === '' || (int) $cleanHarga <= 0) {
            return redirect()->back()->withInput()->with('errors', ['harga' => 'Harga makanan harus lebih besar dari Rp 0.']);
        }

        // Tangani update gambar: Prioritas 1: File lokal baru, Prioritas 2: URL gambar baru, Prioritas 3: Pertahankan gambar lama
        $gambarPath = $makanan['gambar'];
        $gambarUrlInput = trim((string) $this->request->getPost('gambar_url'));

        if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
            $namaFoto = $fotoFile->getRandomName();
            $fotoFile->move(FCPATH . 'uploads/makanan', $namaFoto);
            $gambarPath = 'uploads/makanan/' . $namaFoto;

            // Hapus gambar lama jika tersimpan lokal di folder uploads/
            if (!empty($makanan['gambar']) && strpos($makanan['gambar'], 'uploads/makanan/') === 0) {
                $oldFile = FCPATH . $makanan['gambar'];
                if (file_exists($oldFile)) {
                    @unlink($oldFile);
                }
            }
        } elseif (!empty($gambarUrlInput)) {
            $gambarPath = $gambarUrlInput;
        }

        $data = [
            'kategori_id'       => $this->request->getPost('kategori_id'),
            'nama_makanan'      => $this->request->getPost('nama_makanan'),
            'asal_daerah'       => $this->request->getPost('asal_daerah'),
            'deskripsi_singkat' => $this->request->getPost('deskripsi_singkat'),
            'deskripsi_lengkap' => $this->request->getPost('deskripsi_lengkap'),
            'harga'             => (int) $cleanHarga,
            'stok'              => (int) $this->request->getPost('stok'),
            'rating'            => $this->request->getPost('rating') ?: 4.8,
            'gambar'            => $gambarPath,
        ];

        $this->makananModel->update($id, $data);

        return redirect()->to('/admin/makanan')->with('success', 'Data menu makanan berhasil diperbarui.');
    }

    // Hapus Menu Beserta File Gambar Terkait
    public function delete(int $id)
    {
        $makanan = $this->makananModel->find($id);

        if ($makanan) {
            // Hapus file fisik gambar jika lokal
            if (!empty($makanan['gambar']) && strpos($makanan['gambar'], 'uploads/makanan/') === 0) {
                $oldFile = FCPATH . $makanan['gambar'];
                if (file_exists($oldFile)) {
                    @unlink($oldFile);
                }
            }

            $this->makananModel->delete($id);
            return redirect()->to('/admin/makanan')->with('success', 'Menu makanan berhasil dihapus.');
        }

        return redirect()->to('/admin/makanan')->with('error', 'Data tidak ditemukan.');
    }
}
