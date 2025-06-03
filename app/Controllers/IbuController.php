<?php

namespace App\Controllers;

use App\Models\IbuModel;
use CodeIgniter\RESTful\ResourceController;

class IbuController extends ResourceController
{
    
    protected $modelName = IbuModel::class;
    protected $format = 'json';

    // GET all data
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data);
    }

    // GET single data by ID
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }

    // POST create new data
// POST create new data
public function create()
{
    $input = $this->request->getPost();

    // Cek apakah email sudah ada di database
    $existingEmail = $this->model->where('email', $input['email'])->first();
    if ($existingEmail) {
        return $this->fail('Email sudah terdaftar', 400);
    }

    // Tambahkan tanggal signup
    $input['tanggal_signup'] = date('Y-m-d H:i:s');  // Gunakan date() untuk mendapatkan waktu saat ini

    // Konversi riwayatPenyakit ke JSON
    $input['riwayatPenyakit'] = json_encode($input['riwayatPenyakit']);

    if (!$input['nama'] || !$input['email'] || !$input['password']) {
        return $this->fail('Data tidak lengkap', 400);
    }

    $this->model->insert($input);
    $input['id'] = $this->model->insertID();
    return $this->respondCreated($input);
}


    // PUT update data
    public function update($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }
    
        $input = $this->request->getJSON(true); // Gunakan getJSON untuk menerima data JSON
        if (!$input) {
            return $this->fail("Data tidak valid", 400);
        }
    
        // Cek jika email baru sudah ada di database selain miliknya sendiri
        if (isset($input['email'])) {
            $existingEmail = $this->model->where('email', $input['email'])->where('id !=', $id)->first();
            if ($existingEmail) {
                return $this->fail("Email sudah digunakan oleh pengguna lain", 400);
            }
        }
    
        // Update data
        $this->model->update($id, $input);
        return $this->respond($this->model->find($id));
    }
    

    // DELETE data
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        $this->model->delete($id);
        return $this->respondDeleted(['id' => $id, 'message' => 'Data berhasil dihapus']);
    }
}
