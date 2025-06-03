<?php

namespace App\Models;

use CodeIgniter\Model;

class IbuMenyusuiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kebutuhan_nutrisi_ibu_menyusui'; // Nama tabel
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nutrisi', 'sumber', 'jumlah', 'deskripsi', 'umur'];

    // Fungsi untuk mengambil data dari tabel kebutuhan_nutrisi_ibu_menyusui
    public function getNutrisiMenyusui()
    {
        return $this->findAll(); // Menggunakan metode findAll() untuk mendapatkan data
    }
}
