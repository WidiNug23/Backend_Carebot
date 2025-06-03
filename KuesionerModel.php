<?php

namespace App\Models;

use CodeIgniter\Model;

class KuesionerModel extends Model
{
    protected $table = 'kuesioner'; // Default table, but will be set dynamically
    protected $primaryKey = 'id';
    protected $allowedFields = ['pernyataan'];

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function getPernyataan()
    {
        return $this->findAll();
    }
}
