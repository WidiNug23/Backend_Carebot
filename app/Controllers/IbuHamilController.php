<?php

namespace App\Controllers;

use App\Models\IbuHamilModel;

class IbuHamilController extends BaseController
{
    public function index()
    {
        $model = new IbuHamilModel();
        $data = $model->findAll(); // Mengambil semua data dari tabel 'kebutuhan_nutrisi_remaja'

        return $this->response->setJSON($data); // Mengembalikan data sebagai JSON
    }

        // Retrieve single data by ID (READ)
        public function show($id = null)
        {
            $model = new IbuHamilModel();
            $data = $model->find($id); // Mengambil data berdasarkan ID
    
            if ($data) {
                return $this->response->setJSON($data); // Mengembalikan data dalam format JSON
            } else {
                return $this->response->setStatusCode(404)->setJSON(['message' => 'Data not found']);
            }
        }
    
        // Create new data (CREATE)
        public function create()
        {
            $model = new IbuHamilModel();
            $data = $this->request->getJSON(true); // Mendapatkan data JSON dari request
    
            if ($model->insert($data)) {
                return $this->response->setStatusCode(200)->setJSON(['message' => 'Data created successfully.']);
            } else {
                return $this->response->setStatusCode(400)->setJSON(['message' => 'Failed to create data.']);
            }
        }
    
        // Update data by ID (UPDATE)
        public function update($id = null)
        {
            $model = new IbuHamilModel();
            $data = $this->request->getJSON(true); // Mendapatkan data JSON dari request
    
            if ($model->find($id)) {
                if ($model->update($id, $data)) {
                    return $this->response->setJSON(['message' => 'Data updated successfully.']);
                } else {
                    return $this->response->setStatusCode(400)->setJSON(['message' => 'Failed to update data.']);
                }
            } else {
                return $this->response->setStatusCode(404)->setJSON(['message' => 'Data not found.']);
            }
        }
    
        // Delete data by ID (DELETE)
        public function delete($id = null)
        {
            $model = new IbuHamilModel();
    
            if ($model->find($id)) { // Cek apakah data ada di database
                $model->delete($id); // Hapus data berdasarkan ID
                return $this->response->setJSON(['message' => 'Data deleted successfully.']);
            } else {
                return $this->response->setStatusCode(404)->setJSON(['message' => 'Data not found.']);
            }
        }

    public function getNutrisiPayload()
    {
        $model = new IbuHamilModel();
        $nutrisiData = $model->findAll(); // Mengambil semua data dari tabel 'kebutuhan_nutrisi_remaja'
    
        // Memulai payload dengan data statis
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
                            "parameters" => new \stdClass()  // Menggunakan objek kosong stdClass
                        ]
                    ],
                    [
                        "type" => "divider"
                    ]
                ]
            ]
        ];

        // Menambahkan data dari database ke dalam payload
        foreach ($nutrisiData as $index => $item) {
            // Tambahkan divider sebelum elemen jika bukan yang pertama
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
                    "parameters" => new \stdClass()  // Menggunakan objek kosong stdClass
                ]
            ];
        }
    
        return $this->response->setJSON($payload); // Mengembalikan payload sebagai JSON
    }

    public function getNutrisiByTrimester($trimester = null)
{
    $model = new IbuHamilModel();
    if ($trimester) {
        $data = $model->getNutrisiByTrimester($trimester);
        return $this->response->setJSON($data);
    } else {
        return $this->response->setStatusCode(400)->setJSON(['message' => 'Trimester tidak valid.']);
    }
}


}
