<?php
namespace App\Controllers;

class GeojsonController extends BaseController
{
    public function provinsi()
    {
        $path = FCPATH . 'geojson/kebonsari.geojson';

        if (!file_exists($path)) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'File tidak ditemukan']);
        }

        $json = file_get_contents($path);
        return $this->response->setHeader('Content-Type', 'application/json')->setBody($json);
    }
}
