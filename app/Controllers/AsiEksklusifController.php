<?php
namespace App\Controllers;

use App\Models\AsiEksklusifModel;

class AsiEksklusifController extends BaseController
{
    // Menampilkan data map untuk frontend
    public function getMapData()
    {
        $model = new AsiEksklusifModel();
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }

    // Menambahkan data baru untuk peta
    public function addMapData()
    {
        $model = new AsiEksklusifModel();
        $data = [
            'location' => $this->request->getVar('location'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'description' => $this->request->getVar('description')
        ];
        $model->save($data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data added successfully']);
    }

    // Mengupdate data peta
    public function updateMapData($id_asi_eksklusif)
    {
        $model = new AsiEksklusifModel();
        $data = [
            'location' => $this->request->getVar('location'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'description' => $this->request->getVar('description')
        ];
        $model->update($id_asi_eksklusif, $data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data updated successfully']);
    }

    // Menghapus data peta
    public function deleteMapData($id_asi_eksklusif)
    {
        $model = new AsiEksklusifModel();
        $model->delete($id_asi_eksklusif);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data deleted successfully']);
    }
}
