<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MakananSeeder extends Seeder
{
    public function run()
    {
        // 1. Seed Kategori
        $kategori = [
            ['nama_kategori' => 'Lempok Klasik', 'slug' => 'lempok-klasik', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_kategori' => 'Lempok Varian Rasa', 'slug' => 'lempok-varian-rasa', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_kategori' => 'Paket Oleh-Oleh', 'slug' => 'paket-oleh-oleh', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama_kategori' => 'Kreasi Modern', 'slug' => 'kreasi-modern', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('kategori')->insertBatch($kategori);

        // Ambil ID Kategori
        $katKlasik = $this->db->table('kategori')->where('slug', 'lempok-klasik')->get()->getRowArray()['id'];
        $katVarian = $this->db->table('kategori')->where('slug', 'lempok-varian-rasa')->get()->getRowArray()['id'];
        $katPaket  = $this->db->table('kategori')->where('slug', 'paket-oleh-oleh')->get()->getRowArray()['id'];
        $katModern = $this->db->table('kategori')->where('slug', 'kreasi-modern')->get()->getRowArray()['id'];

        // 2. Seed 9 Variasi Menu Makanan Lempok Durian Bengkulu (Minimal 8 sesuai syarat)
        $makanan = [
            [
                'kategori_id'       => $katKlasik,
                'nama_makanan'      => 'Lempok Durian Original Bengkulu',
                'slug'              => 'lempok-durian-original-bengkulu',
                'asal_daerah'       => 'Kota Bengkulu',
                'deskripsi_singkat' => 'Olahan dodol durian murni 100% daging durian asli tanpa tepung tambahan.',
                'deskripsi_lengkap' => 'Lempok Durian Asli Bengkulu dibuat secara tradisional menggunakan kuali tembaga selama 4-5 jam. Menggunakan 100% daging durian pilihan tanpa campuran tepung, menghasilkan tekstur liat kenyal, legit, dan aroma durian yang sangat pekat.',
                'harga'             => 45000,
                'stok'              => 35,
                'rating'            => 4.9,
                'gambar'            => 'https://i0.wp.com/resepkoki.id/wp-content/uploads/2022/05/Resep-Lempok-Durian.jpg?fit=450%2C600&ssl=1',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'       => $katKlasik,
                'nama_makanan'      => 'Lempok Durian Super Tembaga Premium',
                'slug'              => 'lempok-durian-super-tembaga-premium',
                'asal_daerah'       => 'Bengkulu Tengah',
                'deskripsi_singkat' => 'Kualitas super menggunakan durian tembaga pilihan beraroma tajam harum.',
                'deskripsi_lengkap' => 'Varian grade tertinggi dari Pratama. Menggunakan durian tembaga khas perkebunan Bengkulu Tengah dengan kadar gula alami tinggi, menghasilkan warna cokelat keemasan eksotis dan rasa manis legit yang tahan lama.',
                'harga'             => 65000,
                'stok'              => 20,
                'rating'            => 5.0,
                'gambar'            => 'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=600&auto=format&fit=crop&q=80',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'       => $katVarian,
                'nama_makanan'      => 'Lempok Durian Panggang Wijen',
                'slug'              => 'lempok-durian-panggang-wijen',
                'asal_daerah'       => 'Bengkulu Selatan',
                'deskripsi_singkat' => 'Lempok legit durian berpadu taburan biji wijen sangrai yang harum renyah.',
                'deskripsi_lengkap' => 'Inovasi rasa gurih berpadu manis legit durian. Biji wijen lokal pilihan disangrai kering kemudian dibalutkan merata di atas permukaan lempok durian lembut.',
                'harga'             => 48000,
                'stok'              => 25,
                'rating'            => 4.8,
                'gambar'            => 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=600&auto=format&fit=crop&q=80',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'       => $katVarian,
                'nama_makanan'      => 'Lempok Durian Daun Pandan Wangi',
                'slug'              => 'lempok-durian-daun-pandan-wangi',
                'asal_daerah'       => 'Kaur, Bengkulu',
                'deskripsi_singkat' => 'Sentuhan aroma sari daun pandan alami berpadu dengan daging durian pekat.',
                'deskripsi_lengkap' => 'Diekstrak langsung dari daun pandan segar pesisir Kaur Bengkulu. Menghasilkan warna kehijauan alami yang lembut dan wangi aromaterapi khas yang menenangkan saat disantap.',
                'harga'             => 50000,
                'stok'              => 18,
                'rating'            => 4.7,
                'gambar'            => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=600&auto=format&fit=crop&q=80',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'       => $katVarian,
                'nama_makanan'      => 'Dodol Lempok Gula Aren Curup',
                'slug'              => 'dodol-lempok-gula-aren-curup',
                'asal_daerah'       => 'Rejang Lebong, Bengkulu',
                'deskripsi_singkat' => 'Menggunakan gula aren murni Bukit Kaba yang beraroma karamel smokey.',
                'deskripsi_lengkap' => 'Kombinasi legendaris daging durian lokal Bengkulu dan gula aren cetak asli Bukit Kaba Curup. Memberikan nuansa rasa manis karamel legit yang khas dan tidak serak di tenggorokan.',
                'harga'             => 52000,
                'stok'              => 30,
                'rating'            => 4.9,
                'gambar'            => 'https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?w=600&auto=format&fit=crop&q=80',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'       => $katPaket,
                'nama_makanan'      => 'Lempok Durian Mini Bite Snack Pack',
                'slug'              => 'lempok-durian-mini-bite-snack-pack',
                'asal_daerah'       => 'Kota Bengkulu',
                'deskripsi_singkat' => 'Kemasan travel pack isi 10 potong bite-sized higienis siap santap.',
                'deskripsi_lengkap' => 'Cocok untuk camilan praktis dalam perjalanan atau teman ngopi sore. Masing-masing lempok dibungkus plastik seal food-grade kedap udara sehingga awet dan higienis tanpa mengotori tangan.',
                'harga'             => 35000,
                'stok'              => 50,
                'rating'            => 4.8,
                'gambar'            => 'https://images.unsplash.com/photo-1579954115545-a95591f28bfc?w=600&auto=format&fit=crop&q=80',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'       => $katPaket,
                'nama_makanan'      => 'Pratama Royal Durian Gift Box',
                'slug'              => 'pratama-royal-durian-gift-box',
                'asal_daerah'       => 'Kota Bengkulu',
                'deskripsi_singkat' => 'Paket hampers oleh-oleh eksklusif dengan kotak premium bermotif kain Besurek.',
                'deskripsi_lengkap' => 'Paket bingkisan mewah khas Bengkulu. Berisi 3 varian lempok terfavorit (Original, Tembaga Super, dan Wijen) dalam kotak hardbox mewah berhias ornamen motif tradisional kain Besurek Bengkulu.',
                'harga'             => 120000,
                'stok'              => 15,
                'rating'            => 5.0,
                'gambar'            => 'https://images.unsplash.com/photo-1607344645866-009c320c5ab8?w=600&auto=format&fit=crop&q=80',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'       => $katModern,
                'nama_makanan'      => 'Pancake Lempok Durian Lumer',
                'slug'              => 'pancake-lempok-durian-lumer',
                'asal_daerah'       => 'Kota Bengkulu',
                'deskripsi_singkat' => 'Kulit crepe tipis lembut dengan isian pasta lempok durian lezat meleleh.',
                'deskripsi_lengkap' => 'Fusion pastry modern ala kafe kekinian. Lapisan crepe dadar tipis berwarna pastel yang diisi pasta lempok durian asli Bengkulu dan whipped cream dingin. Disajikan segar setiap hari.',
                'harga'             => 38000,
                'stok'              => 22,
                'rating'            => 4.8,
                'gambar'            => 'https://images.unsplash.com/photo-1528207776546-365bb710ee93?w=600&auto=format&fit=crop&q=80',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'       => $katModern,
                'nama_makanan'      => 'Lempok Durian Crispy Pastry Roll',
                'slug'              => 'lempok-durian-crispy-pastry-roll',
                'asal_daerah'       => 'Kota Bengkulu',
                'deskripsi_singkat' => 'Pastry puff berlapis renyah dengan isian lempok durian hangat karamel.',
                'deskripsi_lengkap' => 'Perpaduan kerenyahan puff pastry khas Eropa dengan keotentikan rasa lempok durian Bengkulu. Dipanggang hingga berwarna cokelat keemasan sempurna, nikmat disantap hangat.',
                'harga'             => 32000,
                'stok'              => 28,
                'rating'            => 4.7,
                'gambar'            => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=600&auto=format&fit=crop&q=80',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('makanan')->insertBatch($makanan);
    }
}
