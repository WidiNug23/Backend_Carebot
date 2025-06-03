<?php
namespace App\Controllers;

use App\Models\MapPanganModel;

class MapPanganController extends BaseController
{
    // Menampilkan data map untuk frontend
    public function getMapData()
    {
        $model = new MapPanganModel();
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }

    // Menambahkan data baru untuk peta
    public function addMapData()
    {
        $model = new MapPanganModel();
        $data = [
            'provinsi' => $this->request->getVar('provinsi'),
            'tahun' => $this->request->getVar('tahun'),
            'kode_wilayah' => $this->request->getVar('kode_wilayah'),
            'prevalensi' => $this->request->getVar('prevalensi'),
            'jumlah_penduduk' => $this->request->getVar('jumlah_penduduk'),
            'penduduk_undernourish' => $this->request->getVar('penduduk_undernourish'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude')
        ];
        $model->save($data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data added successfully']);
    }

    // Mengupdate data peta
    public function updateMapData($id_map_pangan)
    {
        $model = new MapPanganModel();
        $data = [
            'provinsi' => $this->request->getVar('provinsi'),
            'tahun' => $this->request->getVar('tahun'),
            'kode_wilayah' => $this->request->getVar('kode_wilayah'),
            'prevalensi' => $this->request->getVar('prevalensi'),
            'jumlah_penduduk' => $this->request->getVar('jumlah_penduduk'),
            'penduduk_undernourish' => $this->request->getVar('penduduk_undernourish'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude')
        ];
        $model->update($id_map_pangan, $data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data updated successfully']);
    }

    // Menghapus data peta
    public function deleteMapData($id_map_pangan)
    {
        $model = new MapPanganModel();
        $model->delete($id_map_pangan);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data deleted successfully']);
    }
}
