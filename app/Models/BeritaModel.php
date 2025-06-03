<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table            = 'berita';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['judul', 'isi', 'kategori', 'image']; // Add 'image' to allowed fields

    public function getBerita()
    {
        return $this->findAll();
    }

    public function getBeritaById($id)
    {
        return $this->find($id);
    }
}
