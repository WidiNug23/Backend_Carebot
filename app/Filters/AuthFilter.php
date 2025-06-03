<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Inisialisasi sesi
        $session = session();

        // Periksa apakah pengguna sudah login
        if (!$session->get('loggedInUser')) {
            // Redirect ke halaman login jika belum login
            return redirect()->to('/ibu/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan khusus setelah request
    }
}
