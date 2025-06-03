<?php
namespace App\Models;

use CodeIgniter\Model;

class PenyakitModel extends Model
{
    protected $table = 'penyakit'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key tabel

    protected $allowedFields = ['nama_penyakit', 'deskripsi']; // Tambahkan gender dan umur

    protected $returnType = 'array';
    protected $useTimestamps = false;
}
