<?php

namespace App\Models;

use CodeIgniter\Model;

class RASModel extends Model
{
    protected $table = 'ras';
    protected $primaryKey = 'id_ras';
    protected $allowedFields = ['pertanyaan'];
}
