<?php

namespace App\Models;

use CodeIgniter\Model;

class MakananModel extends Model
{
    protected $table            = 'makanan';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'kategori_id', 'nama_makanan', 'slug', 'asal_daerah', 
        'deskripsi_singkat', 'deskripsi_lengkap', 'harga', 
        'stok', 'rating', 'gambar'
    ];
    protected $useTimestamps    = true;

    // Filter pencarian dan sorting sesuai ketentuan soal
    public function getMakananFiltered(?string $keyword = null, ?string $sort = null, ?string $kategoriSlug = null)
    {
        $builder = $this->select('makanan.*, kategori.nama_kategori')
                        ->join('kategori', 'kategori.id = makanan.kategori_id', 'left');

        if (!empty($keyword)) {
            $builder->groupStart()
                    ->like('makanan.nama_makanan', $keyword)
                    ->orLike('makanan.deskripsi_singkat', $keyword)
                    ->orLike('makanan.asal_daerah', $keyword)
                    ->groupEnd();
        }

        if (!empty($kategoriSlug)) {
            $builder->where('kategori.slug', $kategoriSlug);
        }

        switch ($sort) {
            case 'termurah':
                $builder->orderBy('makanan.harga', 'ASC');
                break;
            case 'termahal':
                $builder->orderBy('makanan.harga', 'DESC');
                break;
            case 'rating':
                $builder->orderBy('makanan.rating', 'DESC');
                break;
            case 'nama_asc':
                $builder->orderBy('makanan.nama_makanan', 'ASC');
                break;
            case 'nama_desc':
                $builder->orderBy('makanan.nama_makanan', 'DESC');
                break;
            default:
                $builder->orderBy('makanan.id', 'DESC');
                break;
        }

        return $builder->findAll();
    }
}
