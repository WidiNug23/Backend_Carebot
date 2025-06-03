<?php
namespace App\Models;

use CodeIgniter\Model;

class MapPanganModel extends Model
{
    protected $table = 'map_pangan';
    protected $primaryKey = 'id_map_pangan';
    protected $allowedFields = ['provinsi', 'tahun', 'kode_wilayah', 'prevalensi', 'jumlah_penduduk', 'penduduk_undernourish', 'latitude', 'longitude'];
}
