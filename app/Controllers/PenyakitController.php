<?php
namespace App\Controllers;

use App\Models\PenyakitModel;
use CodeIgniter\RESTful\ResourceController;

class PenyakitController extends ResourceController
{
    protected $penyakitModel;

    public function __construct()
    {
        $this->penyakitModel = new PenyakitModel();
    }

    // Mendapatkan semua data penyakit
    public function index()
    {
        try {
            $penyakit = $this->penyakitModel->findAll();
            return $this->respond($penyakit);
        } catch (\Exception $e) {
            return $this->failServerError('Error fetching data: ' . $e->getMessage());
        }
    }

    // Menambahkan data penyakit
    public function create()
    {
        $data = $this->request->getJSON(); // Ambil data dari body JSON

        // Debugging untuk melihat data yang diterima
        log_message('debug', 'Received Data: ' . json_encode($data));

        // Validasi data input
        if (empty($data->nama_penyakit) || empty($data->deskripsi)) {
            return $this->failValidationErrors('Nama penyakit dan deskripsi wajib diisi.');
        }

        // Menyimpan data ke dalam database
        try {
            $newData = [
                'nama_penyakit' => $data->nama_penyakit,
                'deskripsi' => $data->deskripsi
            ];

            $id = $this->penyakitModel->insert($newData);
            $createdData = $this->penyakitModel->find($id);
            return $this->respondCreated($createdData);
        } catch (\Exception $e) {
            log_message('error', 'Error creating data: ' . $e->getMessage());
            return $this->failServerError('Error creating data: ' . $e->getMessage());
        }
    }

    // Mengambil data penyakit berdasarkan ID
    public function show($id = null)
    {
        $penyakit = $this->penyakitModel->find($id);

        if (!$penyakit) {
            return $this->failNotFound('Penyakit tidak ditemukan');
        }

        return $this->respond($penyakit);
    }

    // Memperbarui data penyakit
    public function update($id = null)
    {
        $data = $this->request->getJSON();

        // Validasi data input
        if (empty($data->nama_penyakit) || empty($data->deskripsi)) {
            return $this->failValidationErrors('Nama penyakit dan deskripsi wajib diisi.');
        }

        try {
            $updatedData = [
                'nama_penyakit' => $data->nama_penyakit,
                'deskripsi' => $data->deskripsi
            ];

            $this->penyakitModel->update($id, $updatedData);
            return $this->respondUpdated($updatedData);
        } catch (\Exception $e) {
            return $this->failServerError('Error updating data: ' . $e->getMessage());
        }
    }

    // Menghapus data penyakit
   // Menghapus data penyakit
public function delete($id = null)
{
    $model = new PenyakitModel();

    if ($model->find($id)) { // Cek apakah data ada di database
        $model->delete($id); // Hapus data berdasarkan ID
        return $this->response->setJSON(['message' => 'Data deleted successfully.']);
    } else {
        return $this->response->setStatusCode(404)->setJSON(['message' => 'Data not found.']);
    }
}

}
