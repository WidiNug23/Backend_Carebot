<?php
namespace App\Models;

use CodeIgniter\Model;

class AsiEksklusifModel extends Model
{
    protected $table = 'map_asi_eksklusif';
    protected $primaryKey = 'id_asi_eksklusif';
    protected $allowedFields = ['location', 'latitude', 'longitude', 'description'];
}
