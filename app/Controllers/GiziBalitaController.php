<?php
namespace App\Controllers;

use App\Models\GiziBalitaModel;

class GiziBalitaController extends BaseController
{
    // Menampilkan data map untuk frontend
    public function getMapData()
    {
        $model = new GiziBalitaModel();
        $data = $model->findAll();

        $response = [
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'count' => count($data),
            'data' => []
        ];

        foreach ($data as $row) {
            $response['data'][] = [
                'id_map_balita' => $row['id_map_balita'] ?? null,
                'tahun' => $row['tahun'],
                'kode_kecamatan' => $row['kode_kecamatan'],
                'nama_kecamatan' => $row['nama_kecamatan'],
                'berat_balita_kurang' => $row['berat_balita_kurang'],
                'balita_pendek' => $row['balita_pendek'],
                'gizi_kurang' => $row['gizi_kurang'],
                'latitude' => $row['latitude'],
                'longitude' => $row['longitude'],
                'geojson' => json_decode($row['geojson'], true)
            ];
        }

        return $this->response->setJSON($response);
    }

    // Menambahkan data baru untuk peta
    public function addMapData()
    {
        $model = new GiziBalitaModel();

        $geojsonFile = $this->request->getFile('geojson');
        $geojsonContent = null;
        $geojsonPath = null;

        if ($geojsonFile && $geojsonFile->isValid() && !$geojsonFile->hasMoved()) {
            $extension = $geojsonFile->getClientExtension();

            if (in_array($extension, ['json', 'geojson'])) {
                $uploadPath = FCPATH . 'uploads/geojson/';

                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $originalName = $geojsonFile->getClientName();
                $destinationPath = $uploadPath . $originalName;

                if (file_exists($destinationPath)) {
                    $filenameOnly = pathinfo($originalName, PATHINFO_FILENAME);
                    $timestamp = time();
                    $originalName = $filenameOnly . '_' . $timestamp . '.' . $extension;
                    $destinationPath = $uploadPath . $originalName;
                }

                $geojsonFile->move($uploadPath, $originalName);
                $geojsonContent = file_get_contents($destinationPath);
                $geojsonPath = 'uploads/geojson/' . $originalName;
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'File GeoJSON harus berekstensi .json atau .geojson.'
                ]);
            }
        }

        $data = [
            'tahun' => $this->request->getVar('tahun'),
            'kode_kecamatan' => $this->request->getVar('kode_kecamatan'),
            'nama_kecamatan' => $this->request->getVar('nama_kecamatan'),
            'berat_balita_kurang' => $this->request->getVar('berat_balita_kurang'),
            'balita_pendek' => $this->request->getVar('balita_pendek'),
            'gizi_kurang' => $this->request->getVar('gizi_kurang'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'geojson' => $geojsonContent
        ];

        $model->save($data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data added successfully',
            'filename' => $geojsonPath ?? null
        ]);
    }

    // Update / edit data map berdasarkan ID
    public function editMapData($id = null)
    {
        $model = new GiziBalitaModel();

        if (!$id) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID tidak ditemukan'
            ]);
        }

        $existing = $model->find($id);
        if (!$existing) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data dengan ID tersebut tidak ditemukan'
            ]);
        }

        $geojsonContent = $existing['geojson']; // default geojson lama

        $geojsonFile = $this->request->getFile('geojson');
        if ($geojsonFile && $geojsonFile->isValid() && !$geojsonFile->hasMoved()) {
            $extension = $geojsonFile->getClientExtension();

            if (in_array($extension, ['json', 'geojson'])) {
                $uploadPath = FCPATH . 'uploads/geojson/';

                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $originalName = $geojsonFile->getClientName();
                $destinationPath = $uploadPath . $originalName;

                if (file_exists($destinationPath)) {
                    $filenameOnly = pathinfo($originalName, PATHINFO_FILENAME);
                    $timestamp = time();
                    $originalName = $filenameOnly . '_' . $timestamp . '.' . $extension;
                    $destinationPath = $uploadPath . $originalName;
                }

                $geojsonFile->move($uploadPath, $originalName);
                $geojsonContent = file_get_contents($destinationPath);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'File GeoJSON harus berekstensi .json atau .geojson.'
                ]);
            }
        }

        $data = [
            'id_map_balita' => $id,
            'tahun' => $this->request->getVar('tahun'),
            'kode_kecamatan' => $this->request->getVar('kode_kecamatan'),
            'nama_kecamatan' => $this->request->getVar('nama_kecamatan'),
            'berat_balita_kurang' => $this->request->getVar('berat_balita_kurang'),
            'balita_pendek' => $this->request->getVar('balita_pendek'),
            'gizi_kurang' => $this->request->getVar('gizi_kurang'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'geojson' => $geojsonContent
        ];

        $model->save($data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil diperbarui'
        ]);
    }

    // Hapus data map berdasarkan ID
    public function deleteMapData($id = null)
    {
        $model = new GiziBalitaModel();

        if (!$id) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID tidak ditemukan'
            ]);
        }

        $existing = $model->find($id);
        if (!$existing) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data dengan ID tersebut tidak ditemukan'
            ]);
        }

        $model->delete($id);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
