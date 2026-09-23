<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateGambarLempokDurian extends Migration
{
    public function up()
    {
        // 1. Update default value kolom gambar pada tabel makanan
        $this->forge->modifyColumn('makanan', [
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => 'https://i0.wp.com/resepkoki.id/wp-content/uploads/2022/05/Resep-Lempok-Durian.jpg?fit=450%2C600&ssl=1',
            ],
        ]);

        // 2. Perbarui baris makanan lempok durian dengan URL autentik
        $db = \Config\Database::connect();
        $db->table('makanan')
            ->whereIn('slug', [
                'lempok-durian-original-bengkulu',
                'lempok-durian-super-tembaga-premium'
            ])
            ->update([
                'gambar' => 'https://i0.wp.com/resepkoki.id/wp-content/uploads/2022/05/Resep-Lempok-Durian.jpg?fit=450%2C600&ssl=1',
            ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('makanan', [
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
            ],
        ]);
    }
}
