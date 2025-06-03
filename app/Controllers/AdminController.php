<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    use ResponseTrait;

    public function login()
    {
        $model = new AdminModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Cek apakah username dan password diisi
        if (!$username || !$password) {
            return $this->fail('Username dan Password harus diisi', 400);
        }

        // Cari admin berdasarkan username
        $admin = $model->getAdminByUsername($username);

        // Cek apakah admin ditemukan dan password sesuai
        if ($admin && password_verify($password, $admin['password'])) {
            // Buat token atau session untuk autentikasi
            $response = [
                'status' => 200,
                'message' => 'Login berhasil',
                'token' => base64_encode($admin['username'] . ':' . $admin['password']), // Contoh sederhana token, sebaiknya gunakan JWT
            ];
            return $this->respond($response);
        } else {
            return $this->fail('Login gagal. Username atau Password salah.', 401);
        }
    }
}
