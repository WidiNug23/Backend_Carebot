<?php

namespace App\Models;

use CodeIgniter\Model;

class KalkulatorGiziModel extends Model
{
    protected $table = 'kebutuhan_gizi'; // Ensure the table name is correct
    protected $primaryKey = 'id'; // Primary key as used
    protected $allowedFields = ['gender', 'weight', 'height', 'age', 'activity_level', 'tdee', 'carbs', 'protein', 'fat', 'ibu_id'];
}
