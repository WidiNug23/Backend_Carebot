<?php
namespace App\Models;

use CodeIgniter\Model;

class IbuModel extends Model
{
    protected $table = 'ibu'; // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 
        'email', 
        'password', 
        'kategori', 
        'gender', 
        'umur', 
        'trimester', 
        'umurMenyusui',
        'riwayatPenyakit',
        'tanggal_signup',
        'reset_token'    
    ];

    // Method untuk mencari ibu berdasarkan nama
    public function getIbuByNama($nama)
    {
        return $this->where('nama', $nama)->first();
    }

    // Method untuk mencari ibu berdasarkan kategori
    public function getIbuByKategori($kategori)
    {
        return $this->where('kategori', $kategori)->findAll();
    }
}
