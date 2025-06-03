<?php

namespace App\Models;

use CodeIgniter\Model;

class BDIModel extends Model
{
    protected $table = 'bdi';
    protected $primaryKey = 'id_bdi';
    protected $allowedFields = ['pernyataan'];

    public function getPernyataanInRange($start, $end)
    {
        return $this->where('id_bdi >=', $start)
                    ->where('id_bdi <=', $end)
                    ->findAll();
    }
}
