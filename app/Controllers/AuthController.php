<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Helper Redirect Berdasarkan Role
    protected function redirectByRole(string $role, string $message = '')
    {
        $redirect = match ($role) {
            'admin'   => redirect()->to('/admin/makanan'),
            'petugas' => redirect()->to('/petugas/pesanan'),
            default   => redirect()->to('/'),
        };

        return $message ? $redirect->with('success', $message) : $redirect;
    }

    // Tampilkan Form Login
    public function login()
    {
        if (session()->get('is_logged_in')) {
            return $this->redirectByRole(session()->get('role') ?? 'user');
        }

        return view('auth/login', [
            'title' => 'Login Pengelola — Pratama Lempok Durian'
        ]);
    }

    // Tampilkan Form Registrasi Pelanggan
    public function register()
    {
        if (session()->get('is_logged_in')) {
            return $this->redirectByRole(session()->get('role') ?? 'user');
        }

        return view('auth/register', [
            'title' => 'Daftar Akun — Pratama Lempok Durian'
        ]);
    }

    // Proses Registrasi Pengguna Baru
    public function processRegister()
    {
        $rules = [
            'nama' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama lengkap wajib diisi.',
                    'min_length' => 'Nama lengkap minimal 3 karakter.',
                    'max_length' => 'Nama lengkap maksimal 100 karakter.',
                ],
            ],
            'username' => [
                'rules'  => 'required|min_length[3]|max_length[50]|alpha_numeric|is_unique[users.username]',
                'errors' => [
                    'required'      => 'Username wajib diisi.',
                    'min_length'    => 'Username minimal 3 karakter.',
                    'max_length'    => 'Username maksimal 50 karakter.',
                    'alpha_numeric' => 'Username hanya boleh berisi huruf dan angka tanpa spasi.',
                    'is_unique'     => 'Username ini sudah terdaftar. Silakan pilih username lain.',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required'    => 'Alamat email wajib diisi.',
                    'valid_email' => 'Format alamat email tidak valid (contoh: user@domain.com).',
                    'is_unique'   => 'Alamat email ini sudah digunakan oleh akun lain.',
                ],
            ],
            'password' => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Kata sandi wajib diisi.',
                    'min_length' => 'Kata sandi minimal 6 karakter demi keamanan.',
                ],
            ],
            'konfirmasi_password' => [
                'rules'  => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi kata sandi wajib diisi.',
                    'matches'  => 'Konfirmasi kata sandi tidak cocok dengan kata sandi di atas.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama'       => $this->request->getPost('nama'),
            'username'   => strtolower($this->request->getPost('username')),
            'email'      => strtolower($this->request->getPost('email')),
            'password'   => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'       => 'user',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->userModel->insert($data);

        return redirect()->to('/login')->with('success', 'Akun berhasil didaftarkan! Silakan login.');
    }

    // Proses Verifikasi Login
    public function processLogin()
    {
        $rules = [
            'username' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Username atau email wajib diisi.',
                ],
            ],
            'password' => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Password wajib diisi.',
                    'min_length' => 'Password minimal harus 6 karakter.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        $user = $this->userModel->where('username', $username)
                                ->orWhere('email', $username)
                                ->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Kombinasi akun dan password tidak cocok.');
        }

        // Set Data Sesi Login
        session()->set([
            'user_id'      => $user['id'],
            'nama'         => $user['nama'],
            'username'     => $user['username'],
            'email'        => $user['email'],
            'role'         => $user['role'],
            'is_logged_in' => true,
        ]);

        return $this->redirectByRole($user['role'], 'Selamat datang kembali, ' . $user['nama'] . '!');
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}
