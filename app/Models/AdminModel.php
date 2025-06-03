<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin'; // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password']; // Kolom yang boleh diisi

    // Method untuk mencari admin berdasarkan username
    public function getAdminByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
