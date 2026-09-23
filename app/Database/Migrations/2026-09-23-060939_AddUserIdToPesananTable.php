<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToPesananTable extends Migration
{
    public function up()
    {
        $fields = [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'kode_pesanan',
            ],
            'makanan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'user_id',
            ],
            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
                'after'      => 'makanan_id',
            ],
        ];

        $this->forge->addColumn('pesanan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pesanan', ['user_id', 'makanan_id', 'jumlah']);
    }
}
