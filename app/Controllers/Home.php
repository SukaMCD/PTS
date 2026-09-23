<?php

namespace App\Controllers;

use App\Models\MakananModel;
use App\Models\KategoriModel;

class Home extends BaseController
{
    protected $makananModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->makananModel  = new MakananModel();
        $this->kategoriModel = new KategoriModel();
    }

    // Dashboard Publik / Homepage Restoran Modern
    public function index(): string
    {
        $keyword  = $this->request->getGet('q');
        $sort     = $this->request->getGet('sort') ?? 'terbaru';
        $kategori = $this->request->getGet('kategori');

        $data = [
            'title'        => 'Pratama Lempok Durian — Cita Rasa Otentik Bengkulu',
            'makanan'      => $this->makananModel->getMakananFiltered($keyword, $sort, $kategori),
            'kategoriList' => $this->kategoriModel->findAll(),
            'keyword'      => $keyword,
            'sort'         => $sort,
            'kategoriAktif'=> $kategori,
            'totalMenu'    => $this->makananModel->countAllResults(),
        ];

        return view('home/index', $data);
    }

    // Halaman Detail Makanan
    public function detail(string $slug): string
    {
        $makanan = $this->makananModel
            ->select('makanan.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id = makanan.kategori_id', 'left')
            ->where('makanan.slug', $slug)
            ->first();

        if (!$makanan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Menu makanan tidak ditemukan: {$slug}");
        }

        // Makanan rekomendasi lainnya
        $rekomendasi = $this->makananModel
            ->where('id !=', $makanan['id'])
            ->orderBy('rating', 'DESC')
            ->findAll(3);

        $data = [
            'title'       => $makanan['nama_makanan'] . ' — Pratama Lempok Durian',
            'makanan'     => $makanan,
            'rekomendasi' => $rekomendasi,
        ];

        return view('home/detail', $data);
    }
}
