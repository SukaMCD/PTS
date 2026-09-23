<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Daftar Semua Pengguna (Khusus Admin)
    public function index(): string
    {
        $keyword = $this->request->getGet('q');
        $query = $this->userModel->orderBy('created_at', 'DESC');

        if ($keyword) {
            $query->like('nama', $keyword)
                  ->orLike('username', $keyword)
                  ->orLike('email', $keyword)
                  ->orLike('role', $keyword);
        }

        $data = [
            'title'     => 'Manajemen Akun Pengguna — Pratama Admin',
            'users'     => $query->findAll(),
            'keyword'   => $keyword,
            'totalUser' => $this->userModel->countAllResults(),
        ];

        return view('admin/users/index', $data);
    }

    // Ubah Peran (Role) Pengguna
    public function updateRole(int $id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Mencegah admin mengubah role akunnya sendiri yang sedang aktif
        if ($user['id'] == session()->get('user_id')) {
            return redirect()->to('/admin/users')->with('error', 'Anda tidak dapat mengubah peran akun Anda sendiri saat sedang login.');
        }

        $newRole = $this->request->getPost('role');
        if (!in_array($newRole, ['admin', 'petugas', 'user'])) {
            return redirect()->to('/admin/users')->with('error', 'Role tidak valid.');
        }

        $this->userModel->update($id, ['role' => $newRole]);

        return redirect()->to('/admin/users')->with('success', "Peran untuk {$user['nama']} berhasil diubah menjadi " . strtoupper($newRole) . ".");
    }

    // Hapus Pengguna
    public function delete(int $id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemukan.');
        }

        if ($user['id'] == session()->get('user_id')) {
            return redirect()->to('/admin/users')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $this->userModel->delete($id);

        return redirect()->to('/admin/users')->with('success', "Akun {$user['nama']} berhasil dihapus.");
    }
}
