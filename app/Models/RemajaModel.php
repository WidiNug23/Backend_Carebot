<?php
namespace App\Models;

use CodeIgniter\Model;

class RemajaModel extends Model
{
    protected $table = 'kebutuhan_nutrisi_remaja'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key tabel

    protected $allowedFields = ['nutrisi', 'sumber', 'jumlah', 'deskripsi', 'gender', 'umur']; // Tambahkan gender dan umur

    protected $returnType = 'array';
    protected $useTimestamps = false;
}
