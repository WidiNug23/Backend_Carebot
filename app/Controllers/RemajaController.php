<?php

namespace App\Controllers;

use App\Models\RemajaModel;
use CodeIgniter\RESTful\ResourceController;

class RemajaController extends ResourceController
{
    // Retrieve all data (READ)
    public function index()
    {
        $model = new RemajaModel();
        $data = $model->findAll(); // Mengambil semua data dari tabel 'kebutuhan_nutrisi_remaja'
        return $this->respond($data); // Mengembalikan data dalam format JSON
    }

    // Retrieve single data by ID (READ)
    public function show($id = null)
    {
        $model = new RemajaModel();
        $data = $model->find($id); // Mengambil data berdasarkan ID

        if ($data) {
            return $this->respond($data); // Mengembalikan data dalam format JSON
        } else {
            return $this->failNotFound('Data not found'); // Menggunakan metode failNotFound
        }
    }

    // Create new data (CREATE)
    public function create()
    {
        $model = new RemajaModel();
        $data = $this->request->getJSON(true); // Mendapatkan data JSON dari request

        if ($model->insert($data)) {
            return $this->respondCreated(['message' => 'Data created successfully.']);
        } else {
            return $this->fail('Failed to create data.'); // Menggunakan metode fail
        }
    }

    // Update data by ID (UPDATE)
    public function update($id = null)
    {
        $model = new RemajaModel();
        $data = $this->request->getJSON(true); // Mendapatkan data JSON dari request

        if ($model->find($id)) {
            if ($model->update($id, $data)) {
                return $this->respond(['message' => 'Data updated successfully.']);
            } else {
                return $this->fail('Failed to update data.'); // Menggunakan metode fail
            }
        } else {
            return $this->failNotFound('Data not found.'); // Menggunakan metode failNotFound
        }
    }

    // Delete data by ID (DELETE)
    public function delete($id = null)
    {
        $model = new RemajaModel();

        if ($model->find($id)) { // Check if data exists in the database
            $model->delete($id); // Delete data by ID
            return $this->respondDeleted(['message' => 'Data deleted successfully.']);
        } else {
            return $this->failNotFound('Data not found.'); // Using failNotFound method
        }
    }

    public function getRecommendations()
{
    $kategori = $this->request->getGet('kategori');
    $penyakit = $this->request->getGet('penyakit'); // riwayat penyakit pengguna dalam format array

    $nutrisiModel = new \App\Models\NutrisiModel();
    $penyakitModel = new \App\Models\PenyakitModel();

    $penyakitList = explode(',', $penyakit); // Konversi string penyakit ke array

    // Filter rekomendasi berdasarkan kategori dan penyakit
    $rekomendasi = $nutrisiModel->where('kategori_user', $kategori)
                                ->whereIn('penyakit_id', $penyakitList)
                                ->findAll();

    return $this->respond($rekomendasi);
}


    // Retrieve nutrition payload for chatbot
    public function getNutrisiPayload()
    {
        $model = new RemajaModel();
        $nutrisiData = $model->findAll(); // Mengambil semua data dari tabel 'kebutuhan_nutrisi_remaja'

        // Membuat payload dengan data statis
        $payload = [
            "richContent" => [
                [
                    [
                        "type" => "list",
                        "title" => "Informasi Nutrisi",
                        "subtitle" => "Berikut adalah informasi nutrisi yang dibutuhkan",
                        "event" => [
                            "name" => "",
                            "languageCode" => "",
                            "parameters" => new \stdClass()  // Menggunakan objek stdClass kosong
                        ]
                    ],
                    [
                        "type" => "divider"
                    ]
                ]
            ]
        ];

        // Menambahkan data dari database ke payload
        foreach ($nutrisiData as $index => $item) {
            if ($index > 0) {
                $payload["richContent"][0][] = [
                    "type" => "divider"
                ];
            }

            $payload["richContent"][0][] = [
                "type" => "list",
                "title" => $item['nutrisi'],
                "subtitle" => $item['sumber'] . ' - ' . $item['jumlah'],
                "event" => [
                    "name" => "",
                    "languageCode" => "",
                    "parameters" => new \stdClass()  // Menggunakan objek stdClass kosong
                ]
            ];
        }

        return $this->respond($payload); // Mengembalikan payload dalam format JSON
    }
}
