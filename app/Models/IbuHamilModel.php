<?php

namespace App\Models;

use CodeIgniter\Model;

class IbuHamilModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kebutuhan_nutrisi_ibu_hamil'; // Tentukan nama tabel
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nutrisi', 'sumber', 'jumlah', 'deskripsi', 'umur'];

    // Fungsi untuk mengambil data dari tabel kebutuhan_nutrisi_ibu_hamil
    public function getNutrisiHamil()
    {
        return $this->where('id IS NOT NULL') // Filter tambahan jika diperlukan
                    ->findAll();
    }

    public function getNutrisiByTrimester($trimester)
{
    return $this->where('trimester', $trimester)->findAll(); // Filter data berdasarkan trimester
}

}
