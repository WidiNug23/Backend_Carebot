<?php

namespace App\Models;

use CodeIgniter\Model;

class GiziBalitaModel extends Model
{
    protected $table            = 'map_balita';
    protected $primaryKey       = 'id_map_balita';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'tahun',
        'kode_kecamatan',
        'nama_kecamatan',
        'geojson',
        'berat_balita_kurang',
        'balita_pendek',
        'gizi_kurang',
        'latitude',
        'longitude'
    ];

    // Optional: Timestamps
    protected $useTimestamps = false;

    // Optional: Validation rules
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
