<?php
namespace App\Models;

use CodeIgniter\Model;

class MapModel extends Model
{
    protected $table = 'map_data';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'latitude', 'longitude', 'description'];
}
