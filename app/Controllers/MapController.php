<?php
namespace App\Controllers;

use App\Models\MapModel;

class MapController extends BaseController
{
    // Menampilkan data map untuk frontend
    public function getMapData()
    {
        $model = new MapModel();
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }

    // Menambahkan data baru untuk peta
    public function addMapData()
    {
        $model = new MapModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'description' => $this->request->getVar('description')
        ];
        $model->save($data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data added successfully']);
    }

    // Mengupdate data peta
    public function updateMapData($id)
    {
        $model = new MapModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'description' => $this->request->getVar('description')
        ];
        $model->update($id, $data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data updated successfully']);
    }

    // Menghapus data peta
    public function deleteMapData($id)
    {
        $model = new MapModel();
        $model->delete($id);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data deleted successfully']);
    }
}
