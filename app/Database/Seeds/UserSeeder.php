<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'       => 'Fabian Pratama (Admin)',
                'username'   => 'admin',
                'email'      => 'admin@pratamafood.com',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Petugas Outlet Bengkulu',
                'username'   => 'petugas',
                'email'      => 'petugas@pratamafood.com',
                'password'   => password_hash('petugas123', PASSWORD_DEFAULT),
                'role'       => 'petugas',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Pelanggan Setia',
                'username'   => 'user',
                'email'      => 'user@gmail.com',
                'password'   => password_hash('user123', PASSWORD_DEFAULT),
                'role'       => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
