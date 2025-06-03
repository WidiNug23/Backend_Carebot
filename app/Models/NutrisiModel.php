<?php
namespace App\Models;

use CodeIgniter\Model;

class NutrisiModel extends Model
{
    protected $table = 'nutrisi';
    protected $primaryKey = 'id';

    protected $allowedFields = ['penyakit_id', 'nutrisi', 'jumlah', 'kategori_user', 'makanan'];

    protected $returnType = 'array';
    protected $useTimestamps = false;
}
