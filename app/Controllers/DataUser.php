<?php

namespace App\Controllers;

use App\Models\IbuModel;
use CodeIgniter\RESTful\ResourceController;

class DataUser extends ResourceController
{
    protected $modelName = 'App\Models\IbuModel';
    protected $format = 'json';

    // GET all data
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    // POST create new data
    public function create()
    {
        $data = $this->request->getJSON(true);

        // Hash password sebelum simpan
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $data['tanggal_signup'] = date('Y-m-d H:i:s');

        if ($this->model->insert($data)) {
            $data['id'] = $this->model->getInsertID();
            return $this->respondCreated($data);
        } else {
            return $this->failValidationErrors($this->model->errors());
        }
    }

    // POST update existing data
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        // Jika password diubah, hash ulang
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']); // jangan update password jika kosong
        }

        if ($this->model->update($id, $data)) {
            return $this->respond($this->model->find($id));
        } else {
            return $this->failValidationErrors($this->model->errors());
        }
    }

    // DELETE data
    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['id' => $id, 'message' => 'Data berhasil dihapus']);
        } else {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }
}
