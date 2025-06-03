<?php

namespace App\Models;

use CodeIgniter\Model;

class LansiaModel extends Model
{
    protected $table = 'kebutuhan_nutrisi_lansia'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key tabel

    protected $allowedFields = ['nutrisi', 'sumber', 'jumlah', 'deskripsi', 'gender', 'umur']; // Kolom yang dapat diisi

    protected $returnType = 'array';
    protected $useTimestamps = false;
}
