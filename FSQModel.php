<?php

namespace App\Models;

use CodeIgniter\Model;

class FSQModel extends Model
{
    protected $table = 'fsq';
    protected $primaryKey = 'id_fsq';
    protected $allowedFields = ['pernyataan'];
}
