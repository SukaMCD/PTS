<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table            = 'pesanan';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'kode_pesanan', 'user_id', 'makanan_id', 'jumlah', 'nama_pelanggan', 'telepon', 'catatan', 'total_bayar', 'status'
    ];
    protected $useTimestamps    = true;
}
