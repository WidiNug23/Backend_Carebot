<?php
namespace App\Controllers;

use App\Models\NutrisiModel;
use CodeIgniter\RESTful\ResourceController;

class NutrisiController extends ResourceController
{
    protected $nutrisiModel;

    public function __construct()
    {
        $this->nutrisiModel = new NutrisiModel();
    }

    // Mendapatkan semua data nutrisi
    public function index()
    {
        try {
            // Join tabel nutrisi dengan penyakit
            $nutrisi = $this->nutrisiModel
                ->select('nutrisi.id, penyakit.nama_penyakit, nutrisi.nutrisi, nutrisi.jumlah, nutrisi.kategori_user, nutrisi.makanan')
                ->join('penyakit', 'penyakit.id = nutrisi.penyakit_id')
                ->findAll();

            return $this->respond($nutrisi);
        } catch (\Exception $e) {
            return $this->failServerError('Error fetching data: ' . $e->getMessage());
        }
    }

    // Menambahkan data nutrisi
    public function create()
    {
        $data = $this->request->getJSON();

        // Validasi data input
        if (empty($data->penyakit_id) || empty($data->nutrisi) || empty($data->jumlah) || empty($data->kategori_user) || empty($data->makanan)) {
            return $this->failValidationErrors('Penyakit ID, Nutrisi, Jumlah, Kategori User, dan Makanan wajib diisi.');
        }

        try {
            $newData = [
                'penyakit_id' => $data->penyakit_id,
                'nutrisi' => $data->nutrisi,
                'jumlah' => $data->jumlah,
                'kategori_user' => $data->kategori_user,
                'makanan' => $data->makanan
            ];

            $id = $this->nutrisiModel->insert($newData);
            $createdData = $this->nutrisiModel->find($id);
            return $this->respondCreated($createdData);
        } catch (\Exception $e) {
            return $this->failServerError('Error creating data: ' . $e->getMessage());
        }
    }

    // Mengambil data nutrisi berdasarkan ID
    public function show($id = null)
    {
        $nutrisi = $this->nutrisiModel->find($id);

        if (!$nutrisi) {
            return $this->failNotFound('Nutrisi tidak ditemukan');
        }

        return $this->respond($nutrisi);
    }

    // Memperbarui data nutrisi
    public function update($id = null)
    {
        $data = $this->request->getJSON();

        // Validasi input data
        if (empty($data->penyakit_id) || empty($data->nutrisi) || empty($data->jumlah) || empty($data->kategori_user) || empty($data->makanan)) {
            return $this->failValidationErrors('Penyakit ID, Nutrisi, Jumlah, Kategori User, dan Makanan wajib diisi.');
        }

        try {
            // Cek apakah data dengan ID tersebut ada
            $existingData = $this->nutrisiModel->find($id);
            if (!$existingData) {
                return $this->failNotFound('Data nutrisi tidak ditemukan.');
            }

            $updatedData = [
                'penyakit_id' => $data->penyakit_id,
                'nutrisi' => $data->nutrisi,
                'jumlah' => $data->jumlah,
                'kategori_user' => $data->kategori_user,
                'makanan' => $data->makanan
            ];

            // Simpan perubahan ke database
            $this->nutrisiModel->update($id, $updatedData);

            // Kembalikan data yang telah diperbarui
            $updatedRecord = $this->nutrisiModel->find($id);
            return $this->respondUpdated($updatedRecord);
        } catch (\Exception $e) {
            return $this->failServerError('Error updating data: ' . $e->getMessage());
        }
    }

    // Menghapus data nutrisi
    public function delete($id = null)
    {
        $model = new NutrisiModel();

        if ($model->find($id)) { // Cek apakah data ada di database
            $model->delete($id); // Hapus data berdasarkan ID
            return $this->response->setJSON(['message' => 'Data deleted successfully.']);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data not found.']);
        }
    }

}
