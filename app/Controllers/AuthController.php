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

    // Tampilkan Form Login
    public function login()
    {
        if (session()->get('is_logged_in')) {
            return redirect()->to('/admin/makanan');
        }

        return view('auth/login', [
            'title' => 'Login Pengelola — Pratama Lempok Durian'
        ]);
    }

    // Proses Verifikasi Login
    public function processLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Username dan password wajib diisi.');
        }

        $username = $this->request->getPost('username');
        $password = (string) $this->request->getPost('password');

        $user = $this->userModel->where('username', $username)
                                ->orWhere('email', $username)
                                ->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Kombinasi username atau password salah.');
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

        return redirect()->to('/admin/makanan')->with('success', 'Selamat datang kembali, ' . $user['nama'] . '!');
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}
